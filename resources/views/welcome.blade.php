@extends('main')
@section('content')
<h1 class="text-3xl font-extrabold mb-8 text-gray-800">Dashboard</h1>

<!-- max-w-5xl e mx-auto centralizam e limitam o tamanho para não ficar gigante -->
<div class="max-w-6xl mx-auto w-full grid grid-cols-2 grid-rows-2 gap-6">
    <div class="bg-white rounded-xl shadow-sm border-t-8 border-blue-500 flex flex-col justify-center items-center hover:shadow-md transition-shadow py-10">
        <h3 class="text-gray-500 font-bold uppercase tracking-wider mb-2 text-sm">Móveis no Catálogo</h3>
        <p class="text-5xl font-black text-gray-800 mb-6">{{ $totalMoveis }}</p>
        <a href="{{ route('movel.index') }}" class="w-2/3 bg-blue-50 py-3 text-center text-blue-600 font-bold hover:bg-blue-100 rounded-lg">Gerenciar Móveis</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-8 border-yellow-500 flex flex-col justify-center items-center hover:shadow-md transition-shadow py-10">
        <h3 class="text-gray-500 font-bold uppercase tracking-wider mb-2 text-sm">Itens em Estoque</h3>
        <p class="text-5xl font-black text-gray-800 mb-6">{{ $totalEstoque }}</p>
        <a href="{{ route('movel.index') }}" class="w-2/3 bg-yellow-50 py-3 text-center text-yellow-600 font-bold hover:bg-yellow-100 rounded-lg">Ver Estoque</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-8 border-green-500 flex flex-col justify-center items-center hover:shadow-md transition-shadow py-10">
        <h3 class="text-gray-500 font-bold uppercase tracking-wider mb-2 text-sm">Vendas Realizadas</h3>
        <p class="text-5xl font-black text-gray-800 mb-2">{{ $totalVendas }}</p>
        <p class="text-lg text-green-600 font-bold mb-4">R$ {{ number_format($faturamento, 2, ',', '.') }}</p>
        <a href="{{ route('venda.index') }}" class="w-2/3 bg-green-50 py-3 text-center text-green-600 font-bold hover:bg-green-100 rounded-lg">Histórico de Vendas</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-8 border-purple-500 flex flex-col justify-center items-center hover:shadow-md transition-shadow py-10">
        <h3 class="text-gray-500 font-bold uppercase tracking-wider mb-2 text-sm">Projetos Sob Medida</h3>
        <p class="text-5xl font-black text-gray-800 mb-6">{{ $totalSobMedida }}</p>
        <a href="{{ route('sob_medida.index') }}" class="w-2/3 bg-purple-50 py-3 text-center text-purple-600 font-bold hover:bg-purple-100 rounded-lg">Ver Projetos</a>
    </div>
</div>
@endsection