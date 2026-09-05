@extends('main')
@section('content')
@php $isEdit = isset($movel) && $movel->id; @endphp

<h1 class="text-3xl font-extrabold mb-8 text-gray-800">{{ $isEdit ? 'Atualizar Móvel' : 'Cadastrar Novo Móvel' }}</h1>

<form action="{{ $isEdit ? route('movel.update', $movel->id) : route('movel.store') }}" method="POST" class="bg-white p-10 shadow-sm rounded-xl border border-gray-100 w-full h-full">
    @csrf
    @if($isEdit) @method('PUT') @endif
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div>
            <label class="block text-sm font-semibold mb-2">Nome do Móvel</label>
            <input type="text" name="nome" value="{{ $isEdit ? $movel->nome : old('nome') }}" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div>
            <label class="block text-sm font-semibold mb-2">Categoria</label>
            <select name="categoria_id" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                @foreach($categorias as $c)
                    <option value="{{ $c->id }}" {{ ($isEdit && $movel->categoria_id == $c->id) ? 'selected' : '' }}>
                        {{ $c->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-semibold mb-2">Material / Cor</label>
            <input type="text" name="material" value="{{ $isEdit ? $movel->material : old('material') }}" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div>
            <label class="block text-sm font-semibold mb-2">Preço de Custo (R$)</label>
            <input type="number" step="0.01" name="preco_custo" value="{{ $isEdit ? $movel->preco_custo : old('preco_custo') }}" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div>
            <label class="block text-sm font-semibold mb-2">Preço de Venda (R$)</label>
            <input type="number" step="0.01" name="preco_venda" value="{{ $isEdit ? $movel->preco_venda : old('preco_venda') }}" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div>
            <label class="block text-sm font-semibold mb-2">Quantidade em Estoque</label>
            <input type="number" step="1" name="quantidade_estoque" value="{{ $isEdit ? $movel->quantidade_estoque : old('quantidade_estoque') }}" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div class="md:col-span-3">
            <label class="block text-sm font-semibold mb-2">Descrição Detalhada (Opcional)</label>
            <textarea name="descricao" rows="3" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500">{{ $isEdit ? $movel->descricao : old('descricao') }}</textarea>
        </div>
    </div>
    
    <button type="submit" class="w-full bg-blue-600 text-white font-bold px-4 py-4 rounded-lg hover:bg-blue-700 text-lg transition-colors">
        {{ $isEdit ? 'Atualizar Móvel' : 'Salvar Novo Móvel' }}
    </button>
</form>
@endsection