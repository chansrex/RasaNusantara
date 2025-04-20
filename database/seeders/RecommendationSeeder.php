<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recommendations = [
            [
                'user_id' => 2, // Budi
                'menu_id' => 3, // Gado-gado
                'reason' => 'Berdasarkan riwayat pesanan dan preferensi makanan Indonesia tradisional',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'user_id' => 2, // Budi
                'menu_id' => 5, // Es Teh Manis
                'reason' => 'Pelengkap sempurna untuk hidangan utama Anda',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'user_id' => 3, // Siti
                'menu_id' => 1, // Nasi Goreng Spesial
                'reason' => 'Menu populer yang mungkin Anda suka',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
            [
                'user_id' => 4, // Dian
                'menu_id' => 2, // Sate Ayam
                'reason' => 'Berdasarkan riwayat pesanan Anda',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
            [
                'user_id' => 4, // Dian
                'menu_id' => 3, // Gado-gado
                'reason' => 'Rekomendasi untuk mencoba menu vegetarian kami',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
        ];

        foreach ($recommendations as $recommendation) {
            DB::table('recommendations')->insert($recommendation);
        }
    }
} 