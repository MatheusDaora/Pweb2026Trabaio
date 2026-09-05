<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Movel;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller {
    public function catalogo(Request $request) {
        // O ->disponivel() foi removido para destravar a tela
        $query = Movel::with('categoria');
        
        if ($request->filled('categoria_id')) $query->where('categoria_id', $request->categoria_id);
        if ($request->filled('search')) $query->where('nome', 'like', "%{$request->search}%");
        
        $moveis = $query->paginate(12);
        $categorias = Categoria::all();
        
        return view('venda.catalogo', compact('moveis', 'categorias'));
    }

    public function index(Request $request) {
        $query = Venda::with('movel');
        
        if ($request->filled('search')) {
            $query->where('cliente_nome', 'like', "%{$request->search}%")
                  ->orWhere('codigo_venda', 'like', "%{$request->search}%");
        }
        
        $vendas = $query->latest()->paginate(12);
        return view('venda.index', compact('vendas'));
    }

    public function create(Request $request) {
        $moveis = Movel::all();
        $movelSelecionado = $request->movel_id ?? null;
        
        return view('venda.create', compact('moveis', 'movelSelecionado'));
    }
    
    public function store(Request $request) {
        $dados = $request->all();
        $movel = \App\Models\Movel::findOrFail($dados['movel_id']);
        
        if ($movel->quantidade_estoque < $dados['quantidade']) {
            return back()->withErrors('Quantidade em estoque insuficiente!');
        }

        // Define o preço unitário com base no valor do móvel
        $dados['preco_unitario'] = $movel->preco_venda;
        $dados['valor_total'] = $movel->preco_venda * $dados['quantidade'];
        $dados['codigo_venda'] = rand(10000, 99999);
        
        \App\Models\Venda::create($dados);
        
        $movel->decrement('quantidade_estoque', $dados['quantidade']);
        
        return redirect()->route('venda.index')->with('success', 'Venda realizada!');
    }

    public function show(Venda $venda) {
        $venda->load('movel.categoria');
        return view('venda.show', compact('venda'));
    }

    public function destroy($id) {
        $venda = Venda::findOrFail($id);
        
        // Proteção: Só devolve para o estoque se o móvel ainda existir no banco
        if ($venda->movel) {
            $venda->movel->increment('quantidade_estoque', $venda->quantidade);
        }
        
        $venda->delete();
        return redirect()->route('venda.index')->with('success', 'Venda cancelada!');
    }
}