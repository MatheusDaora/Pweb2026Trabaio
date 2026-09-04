@extends('main')
@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-800">Gerenciar Categorias</h1>
    <p class="text-gray-500 mt-1">Organize seu catálogo de móveis adicionando novas categorias.</p>
</div>

<!-- BARRA DE BUSCA -->
<div class="bg-white p-4 shadow-sm rounded-xl border border-gray-100 mb-6">
    <form action="{{ route('categoria.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar categoria por nome..." class="w-full border-gray-300 border p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-900 font-semibold">Buscar</button>
        @if(request('search'))
            <a href="{{ route('categoria.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 font-semibold flex items-center">Limpar</a>
        @endif
    </form>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1">
        <div class="bg-white p-6 shadow-sm rounded-xl border border-gray-100">
            <h2 class="text-xl font-bold mb-4 text-gray-700">Nova Categoria</h2>
            <form action="{{ route('categoria.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nome</label>
                    <input type="text" name="nome" class="w-full border-gray-300 border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Descrição</label>
                    <textarea name="descricao" rows="3" class="w-full border-gray-300 border p-3 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                    + Cadastrar
                </button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2 bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden h-fit">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-4 text-sm font-bold text-gray-600 uppercase">Nome</th>
                    <th class="p-4 text-sm font-bold text-gray-600 uppercase text-center">Móveis</th>
                    <th class="p-4 text-sm font-bold text-gray-600 uppercase text-right">Ação</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categorias as $cat)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold text-gray-800">{{ $cat->nome }}</td>
                    <td class="p-4 text-center">
                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">{{ $cat->moveis_count }}</span>
                    </td>
                    <td class="p-4 text-right">
                        <form action="{{ route('categoria.destroy', $cat) }}" method="POST" onsubmit="return confirm('Excluir esta categoria?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm">Remover</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="p-6 text-center text-gray-500">Nenhuma categoria encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $categorias->links() }}</div>
    </div>
</div>
@endsection