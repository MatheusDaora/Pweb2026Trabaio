<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // 1. LISTAR (E BUSCAR)
    public function index(Request $request) {
        $query = Categoria::withCount('moveis');
        
        if ($request->filled('search')) {
            $query->where('nome', 'like', "%{$request->search}%");
        }
        
        $categorias = $query->orderBy('nome')->paginate(10);
        return view('categoria.index', compact('categorias'));
    }

    // 2. SALVAR NOVO
    public function store(Request $request) {
        $request->validate(['nome' => 'required|string|max:255']);
        Categoria::create($request->all());
        
        return redirect()->route('categoria.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    // 3. PREPARAR EDIÇÃO (Reaproveita a tela index)
    public function edit($id) {
        $categoriaEdit = Categoria::findOrFail($id);
        $categorias = Categoria::withCount('moveis')->orderBy('nome')->paginate(10);
        
        return view('categoria.index', compact('categorias', 'categoriaEdit'));
    }

    // 4. SALVAR ATUALIZAÇÃO
    public function update(Request $request, $id) {
        $request->validate(['nome' => 'required|string|max:255']);
        
        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        
        return redirect()->route('categoria.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    // 5. DELETAR
    public function destroy($id) {
        $categoria = Categoria::findOrFail($id);
        
        // Proteção: não exclui se tiver móveis associados
        if ($categoria->moveis()->count() > 0) {
            return redirect()->back()->withErrors('Não é possível excluir uma categoria que possui móveis.');
        }
        
        $categoria->delete();
        return redirect()->route('categoria.index')->with('success', 'Categoria excluída!');
    }
}