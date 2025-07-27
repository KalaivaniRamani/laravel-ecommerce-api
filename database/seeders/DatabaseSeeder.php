<?php

namespace Database\Seeders;

use App\Models\Product;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Product::create([
            'name' => 'Laptop',
            'description' => 'Powerful laptop with 16GB RAM',
            'price' => 999.99,
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Smartphone',
            'description' => 'Latest smartphone model',
            'price' => 699.99,
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'Headphones',
            'description' => 'Noise-cancelling wireless headphones',
            'price' => 199.99,
            'stock' => 30,
        ]);
    }
}
