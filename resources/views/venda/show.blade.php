@extends('main')
@section('content')
<div class="bg-white p-8 shadow rounded max-w-2xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-2 text-center">Recibo de Venda</h1>
    <p class="text-center text-gray-500 mb-6">Código: {{ $venda->codigo_venda }}</p>
    
    <div class="mb-6 border-t border-b py-4">
        <p><strong>Cliente:</strong> {{ $venda->cliente_nome }}</p>
        <p><strong>Contato:</strong> {{ $venda->cliente_cpf_telefone ?? 'Não informado' }}</p>
        <p><strong>Pagamento:</strong> {{ $venda->forma_pagamento }}</p>
        <p><strong>Data:</strong> {{ $venda->created_at->format('d/m/Y H:i') }}</p>
    </div>
    
    <table class="w-full text-left mb-6">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Item</th>
                <th class="p-2">Qtd</th>
                <th class="p-2">Unitário</th>
                <th class="p-2">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-2">{{ $venda->movel->nome }}</td>
                <td class="p-2">{{ $venda->quantidade }}</td>
                <td class="p-2">R$ {{ number_format($venda->preco_unitario, 2, ',', '.') }}</td>
                <td class="p-2 font-bold">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <a href="{{ route('venda.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Voltar para Vendas</a>
    </div>
</div>
@endsection