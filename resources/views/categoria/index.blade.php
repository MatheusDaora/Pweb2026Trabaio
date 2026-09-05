@extends('main')
@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-800">Gerenciar Categorias</h1>
    <p class="text-gray-500 mt-1">Organize seu catálogo de móveis adicionando novas categorias.</p>
</div>

<div class="bg-white p-4 shadow-sm rounded-xl border border-gray-100 mb-6">
    <form action="{{ route('categoria.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar categoria..." class="w-full border-gray-300 border p-2 rounded-lg">
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg font-semibold">Buscar</button>
        @if(request('search'))
            <a href="{{ route('categoria.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold flex items-center">Limpar</a>
        @endif
    </form>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Formulário Dinâmico (Criar ou Atualizar) -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 shadow-sm rounded-xl border {{ isset($categoriaEdit) ? 'border-yellow-400' : 'border-gray-100' }}">
            <h2 class="text-xl font-bold mb-4 text-gray-700">
                {{ isset($categoriaEdit) ? 'Atualizar Categoria' : 'Nova Categoria' }}
            </h2>
            
            <form action="{{ isset($categoriaEdit) ? route('categoria.update', $categoriaEdit->id) : route('categoria.store') }}" method="POST">
                @csrf
                @if(isset($categoriaEdit)) @method('PUT') @endif
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nome</label>
                    <input type="text" name="nome" value="{{ isset($categoriaEdit) ? $categoriaEdit->nome : '' }}" class="w-full border-gray-300 border p-3 rounded-lg" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Breve Descrição</label>
                    <textarea name="descricao" rows="3" placeholder="Digite uma breve descrição da categoria..." class="w-full border-gray-300 border p-3 rounded-lg">{{ isset($categoriaEdit) ? $categoriaEdit->descricao : '' }}</textarea>
                </div>
                
                <button type="submit" class="w-full {{ isset($categoriaEdit) ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-blue-600 hover:bg-blue-700' }} text-white font-bold py-3 px-4 rounded-lg">
                    {{ isset($categoriaEdit) ? 'Salvar Alterações' : '+ Cadastrar' }}
                </button>
                
                @if(isset($categoriaEdit))
                    <a href="{{ route('categoria.index') }}" class="block text-center mt-3 text-sm text-gray-500 hover:underline">Cancelar Edição</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Tabela de Categorias -->
    <div class="lg:col-span-2 bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden h-fit">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-4 text-sm font-bold text-gray-600 uppercase">Nome</th>
                    <th class="p-4 text-sm font-bold text-gray-600 uppercase">Descrição</th>
                    <th class="p-4 text-sm font-bold text-gray-600 uppercase text-center">Móveis</th>
                    <th class="p-4 text-sm font-bold text-gray-600 uppercase text-right">Ação</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categorias as $cat)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold text-gray-800 whitespace-nowrap">{{ $cat->nome }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $cat->descricao ?: '-' }}</td>
                    <td class="p-4 text-center">
                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">{{ $cat->moveis_count }}</span>
                    </td>
                    <td class="p-4 text-right flex justify-end gap-3">
                        <a href="{{ route('categoria.edit', $cat->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold text-sm">Atualizar</a>
                        <form action="{{ route('categoria.destroy', $cat) }}" method="POST" onsubmit="return confirm('Excluir esta categoria?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm">Remover</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">Nenhuma categoria encontrada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $categorias->links() }}</div>
    </div>
</div>
@endsection