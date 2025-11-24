<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Pest\Support\Str;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear categorías reales de tu negocio
        $categorias = [
            'Chopos',
            'Chalinas',
            'Mantas',
            'Bufandas',
            'Gorros',
            'Ponchos',
            'Guantes',
            'Medias de alpaca'
        ];

        foreach ($categorias as $cat) {
            Category::create([
                'name' => $cat,

                'slug' => str($cat)->slug(),
                'description' => "Categoría de productos de {$cat} hechos a mano con lana de alpaca."
            ]);
        }

        // 2. Sedes donde tienes inventario
        $sedes = [
            'Lima Centro',
            'Miraflores',
            'San Isidro',
            'Arequipa',
            'Cusco',
            'Trujillo',
            'Iquitos'
        ];

        // 3. Crear 80 productos reales (puedes cambiar el número)
        for ($i = 1; $i <= 80; $i++) {
            $categoria = Category::inRandomOrder()->first();

            Product::create([
                'category_id' => $categoria->id,
                'name'        => $categoria->name . ' #' . $i,
                'price'       => number_format(rand(35, 280) + (rand(0, 99) / 100), 2),
                'quantity'    => rand(3, 150),
                'location'    => $sedes[array_rand($sedes)],
                'description' => "Producto artesanal de alta calidad - {$categoria->name}. Color y diseño único #{$i}. Hecho a mano en Perú.",
            ]);
        }
    }
}
