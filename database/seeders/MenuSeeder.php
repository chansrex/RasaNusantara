<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam, udang, dan sayuran segar',
                'nutrition_info' => 'Kalori: 450, Protein: 20g, Karbohidrat: 65g, Lemak: 12g',
                'price' => 35000,
                'available' => true,
            ],
            [
                'name' => 'Sate Ayam',
                'description' => 'Sate ayam dengan bumbu kacang khas Indonesia',
                'nutrition_info' => 'Kalori: 320, Protein: 25g, Karbohidrat: 12g, Lemak: 18g',
                'price' => 30000,
                'available' => true,
            ],
            [
                'name' => 'Gado-gado',
                'description' => 'Sayuran segar dengan saus kacang dan kerupuk',
                'nutrition_info' => 'Kalori: 280, Protein: 10g, Karbohidrat: 30g, Lemak: 15g',
                'price' => 25000,
                'available' => true,
            ],
            [
                'name' => 'Soto Ayam',
                'description' => 'Sup ayam dengan kuah bening, tauge, dan bihun',
                'nutrition_info' => 'Kalori: 300, Protein: 18g, Karbohidrat: 40g, Lemak: 8g',
                'price' => 28000,
                'available' => true,
            ],
            [
                'name' => 'Es Teh Manis',
                'description' => 'Teh manis dingin khas Indonesia',
                'nutrition_info' => 'Kalori: 120, Protein: 0g, Karbohidrat: 30g, Lemak: 0g',
                'price' => 8000,
                'available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            $menu['created_at'] = now();
            $menu['updated_at'] = now();
            DB::table('menus')->insert($menu);
        }
    }
} 