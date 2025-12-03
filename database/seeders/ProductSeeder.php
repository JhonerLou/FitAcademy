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
        $products = [
            [
                'name' => 'FitAcademy Whey Protein',
                'description' => 'Premium whey protein isolate for maximum muscle recovery.',
                'category' => 'Supplements', // <--- Added
                'price' => 750000,
                'stock' => 50,
                'image_path' => 'https://placehold.co/600x400/10b981/ffffff?text=Whey+Protein',
            ],
            [
                'name' => 'Creatine Monohydrate',
                'description' => 'Pure micronized creatine for strength and power.',
                'category' => 'Supplements', // <--- Added
                'price' => 350000,
                'stock' => 100,
                'image_path' => 'https://placehold.co/600x400/3b82f6/ffffff?text=Creatine',
            ],
            [
                'name' => 'FitAcademy Lifting Straps',
                'description' => 'Heavy duty straps to help you lift heavier.',
                'category' => 'Accessories', // <--- Added
                'price' => 150000,
                'stock' => 200,
                'image_path' => 'https://placehold.co/600x400/f59e0b/ffffff?text=Straps',
            ],
            [
                'name' => 'Pre-Workout Energy',
                'description' => 'High stim formula for intense training sessions.',
                'category' => 'Supplements', // <--- Added
                'price' => 450000,
                'stock' => 30,
                'image_path' => 'https://placehold.co/600x400/ef4444/ffffff?text=Pre-Workout',
            ],
            [
                'name' => 'Adjustable Dumbbell Set',
                'description' => 'Space-saving adjustable dumbbells (5kg-40kg).',
                'category' => 'Equipment', // <--- Added
                'price' => 2500000,
                'stock' => 10,
                'image_path' => 'https://placehold.co/600x400/8b5cf6/ffffff?text=Dumbbells',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
