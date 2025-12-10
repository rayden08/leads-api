<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'code' => 'PRD-001',
                'name' => 'Paket Basic',
                'price' => 1000000.00,
                'description' => 'Paket layanan dasar'
            ],
            [
                'code' => 'PRD-002',
                'name' => 'Paket Premium',
                'price' => 2500000.00,
                'description' => 'Paket layanan premium'
            ],
            [
                'code' => 'PRD-003',
                'name' => 'Paket Enterprise',
                'price' => 5000000.00,
                'description' => 'Paket untuk perusahaan'
            ],
        ];

        Product::insert($products);
    }
}