@extends('main')
@section('content')
<div class="bg-white p-8 shadow rounded max-w-2xl mx-auto mt-10">
    <div class="flex justify-between items-center border-b pb-4 mb-4">
        <h1 class="text-2xl font-bold">Projeto: {{ $orcamento->tipo_movel }}</h1>
        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded font-bold">{{ $orcamento->status }}</span>
    </div>
    
    <p class="text-gray-500 mb-6">Cód. Orçamento: {{ $orcamento->codigo_orcamento }}</p>
    
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <p class="text-sm text-gray-500">Cliente</p>
            <p class="font-bold">{{ $orcamento->cliente_nome }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Telefone</p>
            <p class="font-bold">{{ $orcamento->cliente_telefone }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Material e Cor</p>
            <p class="font-bold">{{ $orcamento->material }} - {{ $orcamento->cor_acabamento }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Dimensões (L x A x P)</p>
            <p class="font-bold">{{ $orcamento->largura_m }}m x {{ $orcamento->altura_m }}m x {{ $orcamento->profundidade_m }}m</p>
        </div>
    </div>
    
    <div class="flex gap-2 justify-center">
        <a href="{{ route('sob_medida.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Voltar</a>
        <a href="{{ route('sob_medida.edit', $orcamento) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar Projeto</a>
        
        <form action="{{ route('sob_medida.destroy', $orcamento) }}" method="POST" onsubmit="return confirm('Excluir este projeto?')">
            @csrf @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Excluir</button>
        </form>
    </div>
</div>
@endsection