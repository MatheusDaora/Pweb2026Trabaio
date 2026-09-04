@extends('main')
@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $movel->id ? 'Editar Móvel' : 'Novo Móvel' }}</h1>
<form action="{{ $movel->id ? route('movel.update', $movel) : route('movel.store') }}" method="POST" class="bg-white p-6 shadow rounded max-w-2xl">
    @csrf
    @if($movel->id) @method('PUT') @endif
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm mb-1">Nome</label>
            <input type="text" name="nome" value="{{ old('nome', $movel->nome) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Categoria</label>
            <select name="categoria_id" class="w-full border p-2 rounded" required>
                <option value="">Selecione...</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" {{ old('categoria_id', $movel->categoria_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nome }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm mb-1">Preço Custo (R$)</label>
            <input type="number" step="0.01" name="preco_custo" value="{{ old('preco_custo', $movel->preco_custo) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Preço Venda (R$)</label>
            <input type="number" step="0.01" name="preco_venda" value="{{ old('preco_venda', $movel->preco_venda) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Quantidade em Estoque</label>
            <input type="number" name="quantidade_estoque" value="{{ old('quantidade_estoque', $movel->quantidade_estoque) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Status</label>
            <label class="flex items-center mt-2">
                <input type="checkbox" name="ativo" value="1" {{ old('ativo', $movel->ativo ?? true) ? 'checked' : '' }} class="mr-2"> Ativo
            </label>
        </div>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar Móvel</button>
</form>
@endsection