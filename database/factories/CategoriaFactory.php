<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory {
    public function definition(): array {
        return [
            'nome' => $this->faker->unique()->words(2, true),
            'descricao' => $this->faker->sentence(),
        ];
    }
}