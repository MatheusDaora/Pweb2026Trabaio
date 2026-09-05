<?php
namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Movel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovelController extends Controller {
    public function index(Request $request) {
        // Inicia a busca trazendo também a categoria para evitar lentidão
        $query = \App\Models\Movel::with('categoria');
        
        // Se o usuário digitou algo na busca
        if ($request->filled('search')) {
            $search = $request->search;
            
            $query->where('nome', 'like', "%{$search}%")
                  ->orWhere('material', 'like', "%{$search}%")
                  ->orWhereHas('categoria', function($q) use ($search) {
                      $q->where('nome', 'like', "%{$search}%");
                  });
        }
        
        // Pagina os resultados
        $moveis = $query->orderBy('nome')->paginate(10);
        
        return view('movel.index', compact('moveis'));
    }

    public function create() { return view('movel.form', ['movel' => new Movel(), 'categorias' => Categoria::all()]); }

    public function store(Request $request) {
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id', 'nome' => 'required|string|max:255',
            'preco_custo' => 'required|numeric|min:0', 'preco_venda' => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|integer|min:0', 'material' => 'nullable|string',
            'cor' => 'nullable|string', 'imagem' => 'nullable|image|max:2048', 'imagem_url' => 'nullable|url',
        ]);
        $data['ativo'] = $request->has('ativo');
        if ($request->hasFile('imagem')) $data['imagem'] = $request->file('imagem')->store('moveis', 'public');
        elseif ($request->filled('imagem_url')) $data['imagem'] = $request->imagem_url;
        
        Movel::create($data);
        return redirect()->route('movel.index')->with('success', 'Móvel adicionado!');
    }

    public function edit(Movel $movel) { return view('movel.form', ['movel' => $movel, 'categorias' => Categoria::all()]); }

    public function update(Request $request, Movel $movel) {
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id', 'nome' => 'required|string|max:255',
            'preco_custo' => 'required|numeric|min:0', 'preco_venda' => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|integer|min:0', 'material' => 'nullable|string',
            'cor' => 'nullable|string', 'imagem' => 'nullable|image|max:2048', 'imagem_url' => 'nullable|url',
        ]);
        $data['ativo'] = $request->has('ativo');
        if ($request->hasFile('imagem')) {
            if ($movel->imagem && !str_starts_with($movel->imagem, 'http')) Storage::disk('public')->delete($movel->imagem);
            $data['imagem'] = $request->file('imagem')->store('moveis', 'public');
        } elseif ($request->filled('imagem_url')) {
            $data['imagem'] = $request->imagem_url;
        }
        
        $movel->update($data);
        return redirect()->route('movel.index')->with('success', 'Móvel atualizado!');
    }

    public function destroy($id) {
        $movel = \App\Models\Movel::findOrFail($id);
        
        // Verifica se existem vendas desse móvel
        if(\App\Models\Venda::where('movel_id', $movel->id)->exists()) {
             return redirect()->back()->withErrors('Erro: Não é possível excluir um móvel que já possui vendas no histórico.');
        }
        
        $movel->delete();
        return redirect()->route('movel.index')->with('success', 'Móvel excluído do catálogo.');
    }
}