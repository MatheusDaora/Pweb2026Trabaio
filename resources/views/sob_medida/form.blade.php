@extends('main')
@section('content')
@php $isEdit = isset($orcamento) && $orcamento->id; @endphp

<h1 class="text-3xl font-extrabold mb-8 text-gray-800">{{ $isEdit ? 'Atualizar Projeto' : 'Novo Projeto Sob Medida' }}</h1>

<form action="{{ $isEdit ? route('sob_medida.update', $orcamento) : route('sob_medida.store') }}" method="POST" class="bg-white p-10 shadow-sm rounded-xl border border-gray-100 w-full h-full">
    @csrf
    @if($isEdit) @method('PUT') @endif
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div>
            <label class="block text-sm font-semibold mb-2">Nome do Cliente</label>
            <input type="text" name="cliente_nome" value="{{ old('cliente_nome', $orcamento->cliente_nome) }}" class="w-full border p-3 rounded-lg" required>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-2">Telefone (Apenas Números)</label>
            <input type="text" name="cliente_telefone" value="{{ old('cliente_telefone', $orcamento->cliente_telefone) }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full border p-3 rounded-lg" required>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-2">Tipo de Móvel Específico</label>
            <input type="text" name="tipo_movel" value="{{ old('tipo_movel', $orcamento->tipo_movel) }}" class="w-full border p-3 rounded-lg" placeholder="Ex: Armário de Cozinha com Ilha" required>
        </div>
        
        <div>
            <label class="block text-sm font-semibold mb-2">Material</label>
            <select name="material" class="w-full border p-3 rounded-lg" required>
                <option value="MDF Standard" {{ old('material', $orcamento->material) == 'MDF Standard' ? 'selected' : '' }}>MDF Standard</option>
                <option value="MDF Ultra/Hidrófugo" {{ old('material', $orcamento->material) == 'MDF Ultra/Hidrófugo' ? 'selected' : '' }}>MDF Ultra/Hidrófugo</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-2">Cor / Acabamento</label>
            <input type="text" name="cor_acabamento" value="{{ old('cor_acabamento', $orcamento->cor_acabamento) }}" class="w-full border p-3 rounded-lg" required>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-2">Status do Projeto</label>
            <select name="status" class="w-full border p-3 rounded-lg" required>
                <option value="Orçamento" {{ old('status', $orcamento->status) == 'Orçamento' ? 'selected' : '' }}>Orçamento</option>
                <option value="Aprovado" {{ old('status', $orcamento->status) == 'Aprovado' ? 'selected' : '' }}>Aprovado</option>
            </select>
        </div>

        <!-- Medidas em CM -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <label class="block text-sm font-bold text-blue-800 mb-2">Largura (cm)</label>
            <input type="number" step="1" name="largura_m" value="{{ old('largura_m', $orcamento->largura_m) }}" class="w-full border p-3 rounded-lg" required>
        </div>
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <label class="block text-sm font-bold text-blue-800 mb-2">Altura (cm)</label>
            <input type="number" step="1" name="altura_m" value="{{ old('altura_m', $orcamento->altura_m) }}" class="w-full border p-3 rounded-lg" required>
        </div>
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <label class="block text-sm font-bold text-blue-800 mb-2">Profundidade (cm)</label>
            <input type="number" step="1" name="profundidade_m" value="{{ old('profundidade_m', $orcamento->profundidade_m) }}" class="w-full border p-3 rounded-lg" required>
        </div>
    </div>
    
    <button type="submit" class="w-full bg-blue-600 text-white font-bold px-4 py-4 rounded-lg hover:bg-blue-700 text-lg transition-colors">
        {{ $orcamento->id ? 'Atualizar Projeto' : 'Salvar Novo Projeto' }}
    </button>
</form>
@endsection