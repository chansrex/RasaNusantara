<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shifts = [
            [
                'admin_id' => 1, // Admin Restoran
                'start_time' => now()->subDays(3)->setHour(8)->setMinute(0)->setSecond(0),
                'end_time' => now()->subDays(3)->setHour(16)->setMinute(0)->setSecond(0),
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'admin_id' => 1, // Admin Restoran
                'start_time' => now()->subDays(2)->setHour(8)->setMinute(0)->setSecond(0),
                'end_time' => now()->subDays(2)->setHour(16)->setMinute(0)->setSecond(0),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'admin_id' => 1, // Admin Restoran
                'start_time' => now()->subDay()->setHour(8)->setMinute(0)->setSecond(0),
                'end_time' => now()->subDay()->setHour(16)->setMinute(0)->setSecond(0),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'admin_id' => 1, // Admin Restoran
                'start_time' => now()->setHour(8)->setMinute(0)->setSecond(0),
                'end_time' => now()->setHour(16)->setMinute(0)->setSecond(0),
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'admin_id' => 1, // Admin Restoran
                'start_time' => now()->addDay()->setHour(8)->setMinute(0)->setSecond(0),
                'end_time' => now()->addDay()->setHour(16)->setMinute(0)->setSecond(0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($shifts as $shift) {
            DB::table('shifts')->insert($shift);
        }
    }
} 