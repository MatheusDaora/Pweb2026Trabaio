<?php
namespace Database\Factories;
use App\Models\Movel;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendaFactory extends Factory {
    public function definition(): array {
        $movel = Movel::factory()->create();
        $qtd = $this->faker->numberBetween(1, 3);
        return [
            'codigo_venda' => 'VD-' . strtoupper($this->faker->bothify('?????-#####')),
            'movel_id' => $movel->id,
            'quantidade' => $qtd,
            'preco_unitario' => $movel->preco_venda,
            'valor_total' => $movel->preco_venda * $qtd,
            'cliente_nome' => $this->faker->name(),
            'cliente_cpf_telefone' => $this->faker->phoneNumber(),
            'forma_pagamento' => $this->faker->randomElement(['Pix', 'Cartão de Crédito', 'Boleto']),
            'observacoes' => $this->faker->optional()->sentence(),
        ];
    }
}