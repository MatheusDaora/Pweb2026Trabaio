@extends('main')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Histórico de Vendas</h1>
    <a href="{{ route('venda.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700">Cadastrar Venda</a>
</div>

<div class="bg-white p-4 shadow rounded mb-6">
    <form action="{{ route('venda.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por cliente ou código..." class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded font-semibold">Buscar</button>
    </form>
</div>

<!-- GRID DE VENDAS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($vendas as $v)
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
            <div class="flex justify-between items-start mb-4">
                <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded">Cód: {{ $v->codigo_venda }}</span>
                <span class="text-green-600 font-black text-lg">R$ {{ number_format($v->valor_total, 2, ',', '.') }}</span>
            </div>
            <h3 class="font-bold text-gray-800 text-xl mb-1">{{ $v->cliente_nome }}</h3>
            <!-- Proteção para não crashar se o móvel for excluído -->
            <p class="text-gray-500 text-sm mb-4">{{ $v->movel->nome ?? 'Móvel Removido do Sistema' }} (x{{ $v->quantidade }})</p>
        </div>
        
        <div class="flex gap-3 border-t pt-4 mt-2">
            <a href="{{ route('venda.show', $v->id) }}" class="flex-1 text-center bg-blue-50 text-blue-600 py-2 rounded font-semibold hover:bg-blue-100">Recibo</a>
            <form action="{{ route('venda.destroy', $v->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Cancelar esta venda?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full text-center bg-red-50 text-red-600 py-2 rounded font-semibold hover:bg-red-100">Excluir</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 bg-white p-6 text-center text-gray-500 rounded-xl shadow-sm">Nenhuma venda encontrada.</div>
    @endforelse
</div>

<div class="mt-6">{{ $vendas->links() }}</div>
@endsection