<?php
namespace Database\Factories;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovelFactory extends Factory {
    public function definition(): array {
        $precoCusto = $this->faker->randomFloat(2, 100, 2000);
        return [
            'categoria_id' => Categoria::factory(),
            'nome' => $this->faker->words(3, true),
            'descricao' => $this->faker->paragraph(),
            'preco_custo' => $precoCusto,
            'preco_venda' => $precoCusto * 1.8,
            'quantidade_estoque' => $this->faker->numberBetween(0, 50),
            'material' => $this->faker->randomElement(['MDF', 'Madeira Maciça', 'Aço e Vidro', 'Estofado']),
            'cor' => $this->faker->colorName(),
            'ativo' => true,
        ];
    }
}