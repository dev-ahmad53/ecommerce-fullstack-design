<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Apple iPhone 14 Pro',
                'price' => 999.00,
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&auto=format&fit=crop&q=80',
                'description' => 'Latest flagship smartphone with A16 Bionic chip and 48MP camera.',
                'category' => 'Smartphone',
                'stock' => 50
            ],
            [
                'name' => 'Samsung Galaxy Tab S9',
                'price' => 699.00,
                'image' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=300&auto=format&fit=crop&q=80',
                'description' => 'Premium Android tablet with S Pen included.',
                'category' => 'Tablet',
                'stock' => 30
            ],
            [
                'name' => 'Apple MacBook Pro',
                'price' => 1999.00,
                'image' => 'https://images.unsplash.com/photo-1496181130204-7552cc14f1d0?w=300&auto=format&fit=crop&q=80',
                'description' => 'Powerful laptop for professionals with M2 Pro chip.',
                'category' => 'Laptop',
                'stock' => 20
            ],
            [
                'name' => 'Apple Watch Ultra',
                'price' => 799.00,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&auto=format&fit=crop&q=80',
                'description' => 'Most rugged and capable Apple Watch ever.',
                'category' => 'Smart Watch',
                'stock' => 40
            ],
            [
                'name' => 'Poco F5 Pro',
                'price' => 499.00,
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&auto=format&fit=crop&q=80',
                'description' => 'High performance gaming phone with Snapdragon 8+ Gen 1.',
                'category' => 'Gaming Phone',
                'stock' => 60
            ],
            [
                'name' => 'Hi-Fi Wireless Headphones',
                'price' => 90.00,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&auto=format&fit=crop&q=80',
                'description' => 'Over-ear active noise cancelling headphones.',
                'category' => 'Audio',
                'stock' => 100
            ],
            [
                'name' => 'DSLR Professional Camera',
                'price' => 450.00,
                'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=300&auto=format&fit=crop&q=80',
                'description' => 'Professional level DSLR camera bundle.',
                'category' => 'Camera',
                'stock' => 25
            ],
            [
                'name' => 'Premium Soft Chair',
                'price' => 19.00,
                'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=300&auto=format&fit=crop&q=80',
                'description' => 'Ergonomic soft-cushioned lounge chair.',
                'category' => 'Furniture',
                'stock' => 80
            ],
            [
                'name' => 'Glass Electric Kettle',
                'price' => 10.00,
                'image' => 'https://images.unsplash.com/photo-1594228135964-943f25d905aa?w=300&auto=format&fit=crop&q=80',
                'description' => '1.7L capacity glass electric water kettle.',
                'category' => 'Kitchen',
                'stock' => 120
            ],
            [
                'name' => 'Pro Console Gaming Set',
                'price' => 34.00,
                'image' => 'https://images.unsplash.com/photo-1612287230202-1bf1d85d1bdf?w=300&auto=format&fit=crop&q=80',
                'description' => 'Durable console controllers bundle.',
                'category' => 'Gaming',
                'stock' => 45
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}