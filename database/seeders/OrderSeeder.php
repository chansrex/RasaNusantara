<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'user_id' => 2, // Budi Santoso
                'order_type' => 'dine-in',
                'status' => 'ready',
                'payment_method' => 'cash',
                'total_price' => 65000, // Nasi Goreng + Sate Ayam
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => 3, // Siti Aminah
                'order_type' => 'take-away',
                'status' => 'processing',
                'payment_method' => 'credit_card',
                'total_price' => 33000, // Gado-gado + Es Teh Manis
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'user_id' => 4, // Dian Purnama
                'order_type' => 'dine-in',
                'status' => 'pending',
                'payment_method' => 'debit_card',
                'total_price' => 36000, // Soto Ayam + Es Teh Manis
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Budi Santoso
                'order_type' => 'take-away',
                'status' => 'ready',
                'payment_method' => 'e-wallet',
                'total_price' => 28000, // Soto Ayam
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
        ];

        foreach ($orders as $order) {
            DB::table('orders')->insert($order);
        }
    }
} 