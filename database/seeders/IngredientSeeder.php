<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            [
                'name' => 'Beras',
                'stock_quantity' => 50.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Ayam',
                'stock_quantity' => 30.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Telur',
                'stock_quantity' => 100.0,
                'unit' => 'butir',
            ],
            [
                'name' => 'Udang',
                'stock_quantity' => 15.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Bawang Merah',
                'stock_quantity' => 10.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Bawang Putih',
                'stock_quantity' => 8.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Kacang Tanah',
                'stock_quantity' => 20.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Kubis',
                'stock_quantity' => 25.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Tauge',
                'stock_quantity' => 10.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Teh',
                'stock_quantity' => 5.0,
                'unit' => 'kg',
            ],
            [
                'name' => 'Gula',
                'stock_quantity' => 30.0,
                'unit' => 'kg',
            ],
        ];

        foreach ($ingredients as $ingredient) {
            $ingredient['created_at'] = now();
            $ingredient['updated_at'] = now();
            DB::table('ingredients')->insert($ingredient);
        }
    }
} 