<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderItems = [
            // Order 1: Budi (Nasi Goreng + Sate Ayam)
            [
                'order_id' => 1,
                'menu_id' => 1, // Nasi Goreng Spesial
                'custom_notes' => 'Tanpa cabe, tambah kecap',
                'portion_size' => 'large',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'order_id' => 1,
                'menu_id' => 2, // Sate Ayam
                'custom_notes' => 'Bumbu kacang terpisah',
                'portion_size' => 'regular',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            
            // Order 2: Siti (Gado-gado + Es Teh Manis)
            [
                'order_id' => 2,
                'menu_id' => 3, // Gado-gado
                'custom_notes' => 'Tanpa telur, saus kacang lebih banyak',
                'portion_size' => 'regular',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'order_id' => 2,
                'menu_id' => 5, // Es Teh Manis
                'custom_notes' => 'Setengah gula',
                'portion_size' => 'large',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            
            // Order 3: Dian (Soto Ayam + Es Teh Manis)
            [
                'order_id' => 3,
                'menu_id' => 4, // Soto Ayam
                'custom_notes' => 'Tanpa sayur kubis, tambah ayam',
                'portion_size' => 'regular',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'menu_id' => 5, // Es Teh Manis
                'custom_notes' => null,
                'portion_size' => 'regular',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Order 4: Budi (Soto Ayam)
            [
                'order_id' => 4,
                'menu_id' => 4, // Soto Ayam
                'custom_notes' => 'Tidak pedas',
                'portion_size' => 'large',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
        ];

        foreach ($orderItems as $item) {
            DB::table('order_items')->insert($item);
        }
    }
} 