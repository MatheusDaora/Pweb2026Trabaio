@extends('main')
@section('content')
<h1 class="text-3xl font-extrabold mb-8 text-gray-800">Registrar Nova Venda</h1>

@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
        <strong class="font-bold">Atenção!</strong>
        <ul class="list-disc mt-2 ml-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- AVISO SE NÃO TIVER MÓVEL CADASTRADO -->
@if($moveis->isEmpty())
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded">
        <strong>Aviso:</strong> Você não tem nenhum móvel cadastrado no catálogo. Vá até a aba de Móveis e cadastre um item primeiro!
    </div>
@endif

<form action="{{ route('venda.store') }}" method="POST" class="bg-white p-10 shadow-sm rounded-xl border border-gray-100 w-full h-full">
    @csrf
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div>
            <label class="block text-sm font-semibold mb-2 text-gray-700">Nome do Cliente</label>
            <input type="text" name="cliente_nome" value="{{ old('cliente_nome') }}" class="w-full border p-4 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div>
            <label class="block text-sm font-semibold mb-2 text-gray-700">Telefone / Contato</label>
            <input type="text" name="cliente_cpf_telefone" value="{{ old('cliente_cpf_telefone') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full border p-4 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2 text-gray-700">Selecione o Móvel</label>
            <select name="movel_id" class="w-full border p-4 rounded-lg focus:ring-2 focus:ring-blue-500" required {{ $moveis->isEmpty() ? 'disabled' : '' }}>
                <option value="" disabled {{ !isset($movelSelecionado) ? 'selected' : '' }}>Escolha um produto da lista...</option>
                @foreach($moveis as $m)
                    <option value="{{ $m->id }}" {{ (isset($movelSelecionado) && $movelSelecionado == $m->id) ? 'selected' : '' }}>
                        {{ $m->nome }} (Estoque: {{ $m->quantidade_estoque }}) - R$ {{ number_format($m->preco_venda, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2 text-gray-700">Forma de Pagamento</label>
            <select name="forma_pagamento" class="w-full border p-4 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="PIX">PIX</option>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
                <option value="Cartão de Débito">Cartão de Débito</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2 text-gray-700">Quantidade</label>
            <input type="number" step="1" min="1" name="quantidade" value="{{ old('quantidade', 1) }}" class="w-full border p-4 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
    </div>
    
    <button type="submit" class="w-full bg-blue-600 text-white font-bold px-4 py-4 rounded-lg hover:bg-blue-700 text-lg transition-colors" {{ $moveis->isEmpty() ? 'disabled' : '' }}>
        Finalizar Venda
    </button>
</form>
@endsection