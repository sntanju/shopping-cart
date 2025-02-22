<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop',
            'price' => 1000.00,
            'discount_price' => 900.00,
            'description' => 'A high-performance laptop.',
            'image' => 'laptop.jpg'
        ]);

        Product::create([
            'name' => 'Smartphone',
            'price' => 500.00,
            'discount_price' => 450.00,
            'description' => 'Latest model smartphone.',
            'image' => 'smartphone.jpg'
        ]);
    }
}
