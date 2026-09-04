@extends('main')
@section('content')
<h1 class="text-2xl font-bold mb-6">Catálogo de Vendas</h1>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @foreach($moveis as $m)
    <div class="bg-white shadow rounded overflow-hidden flex flex-col">
        <div class="p-4 flex-1">
            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $m->categoria->nome }}</span>
            <h2 class="text-lg font-bold mt-1">{{ $m->nome }}</h2>
            <p class="text-2xl font-bold text-green-600 my-2">R$ {{ number_format($m->preco_venda, 2, ',', '.') }}</p>
            <p class="text-sm text-gray-600">Estoque: {{ $m->quantidade_estoque }}</p>
        </div>
        <div class="p-4 bg-gray-50 border-t">
            <a href="{{ route('venda.create', ['movel_id' => $m->id]) }}" class="block w-full text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Vender Este Item</a>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-6">{{ $moveis->links() }}</div>
@endsection