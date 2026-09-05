<?php
namespace App\Http\Controllers;
use App\Models\MovelSobMedida;
use Illuminate\Http\Request;

class MovelSobMedidaController extends Controller {
    public function index(Request $request) {
        $query = MovelSobMedida::query();
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('cliente_nome', 'like', "%{$search}%")->orWhere('codigo_orcamento', 'like', "%{$search}%");
            });
        }
        $orcamentos = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('sob_medida.index', compact('orcamentos'));
    }

    public function create() { return view('sob_medida.form', ['orcamento' => new MovelSobMedida()]); }

    public function store(Request $request) {
        $dados = $request->all();
        
        // Gera o código numérico curto
        $dados['codigo_orcamento'] = rand(10000, 99999); 
        
        // Calcula a área em m²
        $largura = $dados['largura_m'] ?? 0;
        $altura = $dados['altura_m'] ?? 0;
        $dados['area_m2'] = ($largura * $altura) / 10000;
        
        \App\Models\MovelSobMedida::create($dados);
        return redirect()->route('sob_medida.index')->with('success', 'Projeto salvo!');
    }

    public function update(Request $request, $id) {
        $orcamento = \App\Models\MovelSobMedida::findOrFail($id);
        $dados = $request->all();
        
        $largura = $dados['largura_m'] ?? 0;
        $altura = $dados['altura_m'] ?? 0;
        $dados['area_m2'] = ($largura * $altura) / 10000;
        
        $orcamento->update($dados);
        return redirect()->route('sob_medida.index')->with('success', 'Projeto atualizado!');
    }

    public function edit(MovelSobMedida $sob_medida) { return view('sob_medida.form', ['orcamento' => $sob_medida]); }


    public function show(MovelSobMedida $sob_medida) { return view('sob_medida.show', ['orcamento' => $sob_medida]); }
    
    public function destroy(MovelSobMedida $sob_medida) {
        $sob_medida->delete();
        return redirect()->route('sob_medida.index')->with('success', 'Projeto removido!');
    }

    private function validateData(Request $request) {
        $data = $request->validate([
            'cliente_nome' => 'required|string', 'cliente_telefone' => 'required|string',
            'tipo_movel' => 'required|string', 'material' => 'required|string', 'cor_acabamento' => 'required|string',
            'largura_m' => 'required|numeric|min:0.1', 'altura_m' => 'required|numeric|min:0.1',
            'profundidade_m' => 'required|numeric|min:0.1', 'status' => 'required|string'
        ]);
        $area = $data['largura_m'] * $data['altura_m'];
        $data['area_m2'] = $area;
        $precos = ['MDF Standard (18mm)' => 450, 'MDF Ultra/Hidrófugo' => 580, 'MDF Laqueado Especial' => 820, 'Madeira Maciça Nobre (Cumaru/Teca)' => 1250];
        $precoBase = $precos[$data['material']] ?? 500;
        $data['valor_estimado'] = round($area * $precoBase * (1 + ($data['profundidade_m'] * 0.3)), 2);
        return $data;
    }
}