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
            'name' => $this->faker->randomElement([
                'Tela de Algodón Premium', 'Seda Natural Importada', 'Lana Merino Suave',
                'Lino Blanco Puro', 'Terciopelo Azul Real', 'Mezclilla Resistente',
                'Gabardina Impermeable', 'Encaje Francés Fino', 'Tul Ilusión',
                'Gasa de Seda', 'Satén Brillante', 'Pana Corduroy',
                'Microfibra Estampada', 'Loneta para Tapicería', 'Brocado Dorado',
                'Chifón Ligero', 'Crepé de China', 'Damasco Clásico',
                'Fieltro de Lana', 'Franela a Cuadros', 'Licra Deportiva',
                'Muselina Suave', 'Organza Cristal', 'Popelina de Algodón',
                'Rayón Estampado', 'Tafetán Tornasol', 'Viscosa Fluida'
            ]),
            'sku' => $this->faker->unique()->bothify('??-####'),
            'barcode' => $this->faker->ean13(),
            'unit_of_measure' => $this->faker->randomElement(['metros', 'yardas', 'piezas', 'rollos']),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock_quantity' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
