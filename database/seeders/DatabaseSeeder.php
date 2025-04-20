<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            IngredientSeeder::class,
            MenuIngredientSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            NotificationSeeder::class,
            RecommendationSeeder::class,
            ShiftSeeder::class,
            AttendanceSeeder::class,
        ]);
    }
}
