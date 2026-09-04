@extends('main')
@section('content')
<h1 class="text-2xl font-bold mb-6">Finalizar Venda</h1>
<form action="{{ route('venda.store') }}" method="POST" class="bg-white p-6 shadow rounded max-w-xl">
    @csrf
    <div class="mb-4">
        <label class="block text-sm mb-1">Móvel Selecionado</label>
        <select name="movel_id" class="w-full border p-2 rounded" required readonly>
            @if($movelSelecionado)
                <option value="{{ $movelSelecionado->id }}" selected>{{ $movelSelecionado->nome }} - R$ {{ number_format($movelSelecionado->preco_venda, 2, ',', '.') }} (Estoque: {{ $movelSelecionado->quantidade_estoque }})</option>
            @endif
        </select>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm mb-1">Quantidade</label>
            <input type="number" name="quantidade" value="1" min="1" max="{{ $movelSelecionado->quantidade_estoque ?? 1 }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Forma de Pagamento</label>
            <select name="forma_pagamento" class="w-full border p-2 rounded" required>
                <option value="Pix">Pix</option>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
                <option value="Dinheiro">Dinheiro</option>
            </select>
        </div>
    </div>
    <div class="mb-4">
        <label class="block text-sm mb-1">Nome do Cliente</label>
        <input type="text" name="cliente_nome" class="w-full border p-2 rounded" required>
    </div>
    <button type="submit" class="w-full bg-green-600 text-white py-3 rounded font-bold text-lg mt-4 hover:bg-green-700">Confirmar Venda</button>
</form>
@endsection