@extends('main')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Estoque de Móveis</h1>
    <a href="{{ route('movel.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Adicionar Móvel</a>
</div>

<!-- BARRA DE BUSCA -->
<div class="bg-white p-4 shadow rounded mb-4">
    <form action="{{ route('movel.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nome ou material..." class="w-full border p-2 rounded">
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-900">Buscar</button>
        
        @if(request('search'))
            <a href="{{ route('movel.index') }}" class="bg-red-500 text-white px-4 py-2 rounded font-semibold flex items-center">
                Limpar
            </a>
        @endif
    </form>
</div>

<div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">ID</th>
                <th class="p-3">Nome</th>
                <th class="p-3">Categoria</th>
                <th class="p-3">Estoque</th>
                <th class="p-3">Venda (R$)</th>
                <th class="p-3">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($moveis as $m)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $m->id }}</td>
                <td class="p-3">{{ $m->nome }}</td>
                <td class="p-3">{{ $m->categoria->nome }}</td>
                <td class="p-3 {{ $m->quantidade_estoque == 0 ? 'text-red-600 font-bold' : '' }}">{{ $m->quantidade_estoque }}</td>
                <td class="p-3">{{ number_format($m->preco_venda, 2, ',', '.') }}</td>
                <td class="p-3 flex gap-2">
                    <a href="{{ route('movel.edit', $m) }}" class="text-blue-500 hover:underline font-semibold">Editar</a>
                    <form action="{{ route('movel.destroy', $m) }}" method="POST" onsubmit="return confirm('Excluir este móvel?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline font-semibold">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $moveis->links() }}</div>
</div>
@endsection