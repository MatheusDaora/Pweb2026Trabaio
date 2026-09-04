<?php
namespace Database\Seeders;
use App\Models\Categoria;
use App\Models\Movel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $sala = Categoria::create(['nome' => 'Sala', 'descricao' => 'Sofás, poltronas e painéis.']);
        $jantar = Categoria::create(['nome' => 'Jantar', 'descricao' => 'Mesas e cadeiras.']);

        Movel::create([
            'categoria_id' => $sala->id, 'nome' => 'Sofá Retrátil', 'preco_custo' => 1800, 'preco_venda' => 3200,
            'quantidade_estoque' => 8, 'material' => 'Couro', 'cor' => 'Marrom Café', 'ativo' => true
        ]);
        
        // Exemplo: criar mais registros usando a factory
        // \App\Models\Venda::factory(10)->create();
    }
}