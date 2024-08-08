<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed categories
        $categories = [
            ['name' => 'Minuman'],
            ['name' => 'Makanan'],
            ['name' => 'Promo'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Seed products
        $products = [
            ['name' => 'Jeruk', 'category_id' => 1, 'variant' => 'DINGIN', 'price' => 12000, 'printer' => 'Printer Bar'],
            ['name' => 'Jeruk', 'category_id' => 1, 'variant' => 'PANAS', 'price' => 10000, 'printer' => 'Printer Bar'],
            ['name' => 'Teh', 'category_id' => 1, 'variant' => 'MANIS', 'price' => 8000, 'printer' => 'Printer Bar'],
            ['name' => 'Teh', 'category_id' => 1, 'variant' => 'TAWAR', 'price' => 5000, 'printer' => 'Printer Bar'],
            ['name' => 'Kopi', 'category_id' => 1, 'variant' => 'DINGIN', 'price' => 8000, 'printer' => 'Printer Bar'],
            ['name' => 'Kopi', 'category_id' => 1, 'variant' => 'PANAS', 'price' => 6000, 'printer' => 'Printer Bar'],
            ['name' => 'Mie Goreng', 'category_id' => 2, 'variant' => '', 'price' => 15000, 'printer' => 'Printer Dapur'],
            ['name' => 'Mie Kuah', 'category_id' => 2, 'variant' => '', 'price' => 15000, 'printer' => 'Printer Dapur'],
            ['name' => 'Nasi Goreng', 'category_id' => 2, 'variant' => '', 'price' => 15000, 'printer' => 'Printer Dapur'],
            ['name' => 'Nasi Goreng + Jeruk Dingin', 'category_id' => 3, 'variant' => '', 'price' => 23000, 'printer' => 'Printer Dapur & Printer Bar'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
