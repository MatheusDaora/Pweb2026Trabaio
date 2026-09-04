<?php
namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Movel;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller {
    public function catalogo(Request $request) {
        $query = Movel::with('categoria')->disponivel();
        if ($request->filled('categoria_id')) $query->where('categoria_id', $request->categoria_id);
        if ($request->filled('search')) $query->where('nome', 'like', "%{$request->search}%");
        
        $moveis = $query->paginate(12);
        $categorias = Categoria::all();
        return view('venda.catalogo', compact('moveis', 'categorias'));
    }

    public function index(Request $request) {
        $query = Venda::with('movel');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('cliente_nome', 'like', "%{$search}%")
                  ->orWhere('codigo_venda', 'like', "%{$search}%");
        }
        
        $vendas = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('venda.index', compact('vendas'));
    }

    public function create(Request $request) {
        $movelSelecionado = $request->filled('movel_id') ? Movel::disponivel()->find($request->movel_id) : null;
        $moveisDisponiveis = Movel::disponivel()->get();
        return view('venda.form', compact('moveisDisponiveis', 'movelSelecionado'));
    }

    public function store(Request $request) {
        $request->validate([
            'cliente_nome' => 'required|string|max:255', 'forma_pagamento' => 'required|string',
            'movel_id' => 'required|exists:moveis,id', 'quantidade' => 'required|integer|min:1'
        ]);

        $movel = Movel::findOrFail($request->movel_id);
        if ($movel->quantidade_estoque < $request->quantidade) {
            return back()->withErrors(['quantidade' => "Estoque insuficiente! Restam {$movel->quantidade_estoque} un."])->withInput();
        }

        DB::beginTransaction();
        try {
            $venda = Venda::create([
                'codigo_venda' => 'VD-' . strtoupper(uniqid()), 'movel_id' => $movel->id,
                'quantidade' => $request->quantidade, 'preco_unitario' => $movel->preco_venda,
                'valor_total' => $movel->preco_venda * $request->quantidade,
                'cliente_nome' => $request->cliente_nome, 'cliente_cpf_telefone' => $request->cliente_cpf_telefone,
                'forma_pagamento' => $request->forma_pagamento, 'observacoes' => $request->observacoes
            ]);
            $movel->decrement('quantidade_estoque', $request->quantidade);
            DB::commit();
            return redirect()->route('venda.show', $venda->id)->with('success', 'Venda realizada!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Venda $venda) {
        $venda->load('movel.categoria');
        return view('venda.show', compact('venda'));
    }

    public function destroy($id) {
        $venda = \App\Models\Venda::findOrFail($id);
        
        // Devolve o item cancelado para o estoque
        $venda->movel()->increment('quantidade_estoque', $venda->quantidade);
        
        // Exclui o registro da venda
        $venda->delete();
        
        return redirect()->route('venda.index')->with('success', 'Venda cancelada e estoque restaurado!');
    }
}