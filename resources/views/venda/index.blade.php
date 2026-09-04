@extends('main')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Histórico de Vendas</h1>
</div>

<!-- BARRA DE BUSCA -->
<div class="bg-white p-4 shadow rounded mb-4">
    <form action="{{ route('venda.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por cliente ou código da venda..." class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-900 font-semibold">Buscar</button>
        @if(request('search'))
            <a href="{{ route('venda.index') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 font-semibold flex items-center">Limpar</a>
        @endif
    </form>
</div>

<div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Código</th>
                <th class="p-3">Cliente</th>
                <th class="p-3">Móvel</th>
                <th class="p-3">Total (R$)</th>
                <th class="p-3">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vendas as $v)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $v->codigo_venda }}</td>
                <td class="p-3">{{ $v->cliente_nome }}</td>
                <td class="p-3">{{ $v->movel->nome }} (x{{ $v->quantidade }})</td>
                <td class="p-3 font-bold text-green-600">{{ number_format($v->valor_total, 2, ',', '.') }}</td>
                <td class="p-3 flex gap-3">
                    <a href="{{ route('venda.show', $v->id) }}" class="text-blue-500 hover:underline font-semibold">Recibo</a>
                    <form action="{{ route('venda.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Cancelar/Excluir esta venda?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline font-semibold">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-6 text-center text-gray-500">Nenhuma venda encontrada.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $vendas->links() }}</div>
</div>
@endsection