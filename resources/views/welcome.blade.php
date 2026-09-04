@extends('main')
@section('content')
<h1 class="text-3xl font-extrabold mb-8 text-gray-800">Dashboard de Controle</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border-t-4 border-blue-500 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div class="p-6">
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Móveis no Catálogo</h3>
            <p class="text-4xl font-black text-gray-800">{{ $totalMoveis }}</p>
        </div>
        <a href="{{ route('movel.index') }}" class="block w-full bg-gray-50 py-3 text-center text-blue-600 font-semibold hover:bg-gray-100 rounded-b-xl border-t border-gray-100">
            Gerenciar Móveis &rarr;
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-yellow-500 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div class="p-6">
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Itens em Estoque</h3>
            <p class="text-4xl font-black text-gray-800">{{ $totalEstoque }}</p>
        </div>
        <a href="{{ route('movel.index') }}" class="block w-full bg-gray-50 py-3 text-center text-yellow-600 font-semibold hover:bg-gray-100 rounded-b-xl border-t border-gray-100">
            Ver Estoque &rarr;
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-green-500 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div class="p-6">
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Vendas Realizadas</h3>
            <p class="text-4xl font-black text-gray-800">{{ $totalVendas }}</p>
            <p class="text-sm text-green-600 font-bold mt-2 bg-green-50 inline-block px-2 py-1 rounded">R$ {{ number_format($faturamento, 2, ',', '.') }}</p>
        </div>
        <a href="{{ route('venda.index') }}" class="block w-full bg-gray-50 py-3 text-center text-green-600 font-semibold hover:bg-gray-100 rounded-b-xl border-t border-gray-100">
            Histórico de Vendas &rarr;
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-purple-500 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div class="p-6">
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Projetos Sob Medida</h3>
            <p class="text-4xl font-black text-gray-800">{{ $totalSobMedida }}</p>
        </div>
        <a href="{{ route('sob_medida.index') }}" class="block w-full bg-gray-50 py-3 text-center text-purple-600 font-semibold hover:bg-gray-100 rounded-b-xl border-t border-gray-100">
            Ver Projetos &rarr;
        </a>
    </div>
</div>
@endsection