<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'imma210809@gmail.com',
            'password'=> bcrypt('Joalim123@')
        ]);
        $this->call(StoreSeeder::class);
        $this->call(SalesSeeder::class);
        $this->call(InventorySeeder::class);
    }
}
