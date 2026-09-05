@extends('main')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Projetos Sob Medida</h1>
    <a href="{{ route('sob_medida.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Novo Projeto</a>
</div>

<!-- BARRA DE BUSCA -->
<div class="bg-white p-4 shadow rounded mb-4">
    <form action="{{ route('sob_medida.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por cliente ou código..." class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-900">Buscar</button>
        @if(request('search'))
            <a href="{{ route('sob_medida.index') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Limpar</a>
        @endif
    </form>
</div>

<div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Cód.</th>
                <th class="p-3">Cliente</th>
                <th class="p-3">Tipo</th>
                <th class="p-3">Status</th>
                <!-- A coluna "Valor" foi removida daqui -->
                <th class="p-3">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orcamentos as $o)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $o->codigo_orcamento }}</td>
                <td class="p-3">{{ $o->cliente_nome }}</td>
                <td class="p-3">{{ $o->tipo_movel }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded bg-gray-100 border border-gray-300 font-semibold">{{ $o->status }}</span>
                </td>
                <td class="p-3 flex gap-3">
                    <a href="{{ route('sob_medida.show', $o) }}" class="text-blue-500 hover:underline">Ver</a>
                    <a href="{{ route('sob_medida.edit', $o) }}" class="text-yellow-600 hover:underline">Atualizar</a>
                    <form action="{{ route('sob_medida.destroy', $o) }}" method="POST" onsubmit="return confirm('Excluir este projeto?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $orcamentos->links() }}</div>
</div>
@endsection