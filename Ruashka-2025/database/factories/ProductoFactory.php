<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'sku' => $this->faker->unique()->bothify('??-####'),
            'barcode' => $this->faker->ean13(),
            'unit_of_measure' => $this->faker->randomElement(['metros', 'yardas', 'piezas']),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock_quantity' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
