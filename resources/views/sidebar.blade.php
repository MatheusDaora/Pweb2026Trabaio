<aside class="w-64 bg-gray-900 text-white p-6 hidden md:block">
    <h2 class="text-2xl font-bold mb-6 text-center">Moveis dos </h2>
    <nav class="space-y-2">
        <a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Dashboard</a>
        <a href="{{ route('venda.catalogo') }}" class="block py-2 px-4 hover:bg-gray-700 rounded text-blue-300">Móveis Disponíveis</a>
        <hr class="border-gray-700 my-4">
        <a href="{{ route('categoria.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Categorias</a>
        <a href="{{ route('movel.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Estoque de Móveis</a>
        <a href="{{ route('venda.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Histórico de Vendas</a>
        <a href="{{ route('sob_medida.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Projetos Sob Medida</a>
    </nav>
</aside>