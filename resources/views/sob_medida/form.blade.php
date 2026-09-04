@extends('main')
@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $orcamento->id ? 'Editar Projeto' : 'Novo Projeto Sob Medida' }}</h1>
<form action="{{ $orcamento->id ? route('sob_medida.update', $orcamento) : route('sob_medida.store') }}" method="POST" class="bg-white p-6 shadow rounded max-w-2xl">
    @csrf
    @if($orcamento->id) @method('PUT') @endif
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm mb-1">Nome do Cliente</label>
            <input type="text" name="cliente_nome" value="{{ old('cliente_nome', $orcamento->cliente_nome) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Telefone</label>
            <input type="text" name="cliente_telefone" value="{{ old('cliente_telefone', $orcamento->cliente_telefone) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Tipo de Móvel (Ex: Armário)</label>
            <input type="text" name="tipo_movel" value="{{ old('tipo_movel', $orcamento->tipo_movel) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Material</label>
            <select name="material" class="w-full border p-2 rounded" required>
                <option value="MDF Standard (18mm)" {{ old('material', $orcamento->material) == 'MDF Standard (18mm)' ? 'selected' : '' }}>MDF Standard (18mm)</option>
                <option value="MDF Ultra/Hidrófugo" {{ old('material', $orcamento->material) == 'MDF Ultra/Hidrófugo' ? 'selected' : '' }}>MDF Ultra/Hidrófugo</option>
                <option value="MDF Laqueado Especial" {{ old('material', $orcamento->material) == 'MDF Laqueado Especial' ? 'selected' : '' }}>MDF Laqueado Especial</option>
            </select>
        </div>
        <div>
            <label class="block text-sm mb-1">Cor / Acabamento</label>
            <input type="text" name="cor_acabamento" value="{{ old('cor_acabamento', $orcamento->cor_acabamento) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Status</label>
            <select name="status" class="w-full border p-2 rounded" required>
                <option value="Orçamento" {{ old('status', $orcamento->status) == 'Orçamento' ? 'selected' : '' }}>Orçamento</option>
                <option value="Aprovado" {{ old('status', $orcamento->status) == 'Aprovado' ? 'selected' : '' }}>Aprovado</option>
                <option value="Em Produção" {{ old('status', $orcamento->status) == 'Em Produção' ? 'selected' : '' }}>Em Produção</option>
                <option value="Pronto" {{ old('status', $orcamento->status) == 'Pronto' ? 'selected' : '' }}>Pronto</option>
                <option value="Entregue" {{ old('status', $orcamento->status) == 'Entregue' ? 'selected' : '' }}>Entregue</option>
            </select>
        </div>
        <div>
            <label class="block text-sm mb-1">Largura (m)</label>
            <input type="number" step="0.01" name="largura_m" value="{{ old('largura_m', $orcamento->largura_m) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Altura (m)</label>
            <input type="number" step="0.01" name="altura_m" value="{{ old('altura_m', $orcamento->altura_m) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Profundidade (m)</label>
            <input type="number" step="0.01" name="profundidade_m" value="{{ old('profundidade_m', $orcamento->profundidade_m) }}" class="w-full border p-2 rounded" required>
        </div>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar Projeto</button>
</form>
@endsection