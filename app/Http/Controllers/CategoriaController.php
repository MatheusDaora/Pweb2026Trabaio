<?php
namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller {
    public function index(Request $request) {
        $query = Categoria::withCount('moveis');
        
        if ($request->filled('search')) {
            $query->where('nome', 'like', "%{$request->search}%");
        }
        
        $categorias = $query->orderBy('nome')->paginate(10);
        return view('categoria.index', compact('categorias'));
    }

    public function store(Request $request) {
        $request->validate(['nome' => 'required|string|max:255']);
        Categoria::create($request->all());
        return redirect()->route('categoria.index')->with('success', 'Categoria cadastrada!');
    }

    public function destroy(Categoria $categoria) {
        $categoria->delete();
        return redirect()->route('categoria.index')->with('success', 'Categoria excluída!');
    }
}