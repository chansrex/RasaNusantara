<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuIngredients = [
            // Nasi Goreng Spesial (ID: 1)
            [
                'menu_id' => 1,
                'ingredient_id' => 1, // Beras
                'quantity_required' => 0.2, // 200 gram
            ],
            [
                'menu_id' => 1,
                'ingredient_id' => 2, // Ayam
                'quantity_required' => 0.1, // 100 gram
            ],
            [
                'menu_id' => 1,
                'ingredient_id' => 3, // Telur
                'quantity_required' => 1, // 1 butir
            ],
            [
                'menu_id' => 1,
                'ingredient_id' => 4, // Udang
                'quantity_required' => 0.05, // 50 gram
            ],
            [
                'menu_id' => 1,
                'ingredient_id' => 5, // Bawang Merah
                'quantity_required' => 0.02, // 20 gram
            ],
            [
                'menu_id' => 1,
                'ingredient_id' => 6, // Bawang Putih
                'quantity_required' => 0.01, // 10 gram
            ],

            // Sate Ayam (ID: 2)
            [
                'menu_id' => 2,
                'ingredient_id' => 2, // Ayam
                'quantity_required' => 0.15, // 150 gram
            ],
            [
                'menu_id' => 2,
                'ingredient_id' => 7, // Kacang Tanah
                'quantity_required' => 0.05, // 50 gram
            ],
            [
                'menu_id' => 2,
                'ingredient_id' => 6, // Bawang Putih
                'quantity_required' => 0.01, // 10 gram
            ],

            // Gado-gado (ID: 3)
            [
                'menu_id' => 3,
                'ingredient_id' => 7, // Kacang Tanah
                'quantity_required' => 0.1, // 100 gram
            ],
            [
                'menu_id' => 3,
                'ingredient_id' => 8, // Kubis
                'quantity_required' => 0.1, // 100 gram
            ],
            [
                'menu_id' => 3,
                'ingredient_id' => 9, // Tauge
                'quantity_required' => 0.05, // 50 gram
            ],

            // Soto Ayam (ID: 4)
            [
                'menu_id' => 4,
                'ingredient_id' => 2, // Ayam
                'quantity_required' => 0.15, // 150 gram
            ],
            [
                'menu_id' => 4,
                'ingredient_id' => 9, // Tauge
                'quantity_required' => 0.05, // 50 gram
            ],
            [
                'menu_id' => 4,
                'ingredient_id' => 6, // Bawang Putih
                'quantity_required' => 0.02, // 20 gram
            ],

            // Es Teh Manis (ID: 5)
            [
                'menu_id' => 5,
                'ingredient_id' => 10, // Teh
                'quantity_required' => 0.01, // 10 gram
            ],
            [
                'menu_id' => 5,
                'ingredient_id' => 11, // Gula
                'quantity_required' => 0.03, // 30 gram
            ],
        ];

        foreach ($menuIngredients as $item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            DB::table('menu_ingredients')->insert($item);
        }
    }
} 