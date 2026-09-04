<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovelSobMedidaFactory extends Factory {
    public function definition(): array {
        $largura = $this->faker->randomFloat(2, 0.5, 4.0);
        $altura = $this->faker->randomFloat(2, 0.5, 2.8);
        $area = $largura * $altura;
        return [
            'codigo_orcamento' => 'MED-' . strtoupper($this->faker->bothify('?????-#####')),
            'cliente_nome' => $this->faker->name(),
            'cliente_telefone' => $this->faker->phoneNumber(),
            'tipo_movel' => $this->faker->randomElement(['Armário', 'Cozinha', 'Painel de TV']),
            'material' => $this->faker->randomElement(['MDF Standard (18mm)', 'MDF Ultra/Hidrófugo', 'MDF Laqueado Especial']),
            'cor_acabamento' => $this->faker->colorName(),
            'largura_m' => $largura,
            'altura_m' => $altura,
            'profundidade_m' => $this->faker->randomFloat(2, 0.3, 0.8),
            'area_m2' => $area,
            'valor_estimado' => $area * 500,
            'status' => $this->faker->randomElement(['Orçamento', 'Aprovado', 'Em Produção', 'Pronto', 'Entregue']),
            'especificacoes_tecnicas' => $this->faker->optional()->paragraph(),
        ];
    }
}