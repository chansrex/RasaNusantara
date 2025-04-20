<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attendances = [
            [
                'user_id' => 1, // Admin Restoran
                'shift_id' => 1,
                'check_in' => now()->subDays(3)->setHour(7)->setMinute(50)->setSecond(0),
                'check_out' => now()->subDays(3)->setHour(16)->setMinute(5)->setSecond(0),
                'created_at' => now()->subDays(3)->setHour(7)->setMinute(50)->setSecond(0),
                'updated_at' => now()->subDays(3)->setHour(16)->setMinute(5)->setSecond(0),
            ],
            [
                'user_id' => 1, // Admin Restoran
                'shift_id' => 2,
                'check_in' => now()->subDays(2)->setHour(8)->setMinute(5)->setSecond(0),
                'check_out' => now()->subDays(2)->setHour(16)->setMinute(10)->setSecond(0),
                'created_at' => now()->subDays(2)->setHour(8)->setMinute(5)->setSecond(0),
                'updated_at' => now()->subDays(2)->setHour(16)->setMinute(10)->setSecond(0),
            ],
            [
                'user_id' => 1, // Admin Restoran
                'shift_id' => 3,
                'check_in' => now()->subDay()->setHour(7)->setMinute(55)->setSecond(0),
                'check_out' => now()->subDay()->setHour(16)->setMinute(0)->setSecond(0),
                'created_at' => now()->subDay()->setHour(7)->setMinute(55)->setSecond(0),
                'updated_at' => now()->subDay()->setHour(16)->setMinute(0)->setSecond(0),
            ],
            [
                'user_id' => 1, // Admin Restoran
                'shift_id' => 4,
                'check_in' => now()->setHour(7)->setMinute(45)->setSecond(0),
                'check_out' => null, // Belum checkout
                'created_at' => now()->setHour(7)->setMinute(45)->setSecond(0),
                'updated_at' => now()->setHour(7)->setMinute(45)->setSecond(0),
            ],
            [
                'user_id' => 1, // Admin Restoran
                'shift_id' => 5,
                'check_in' => null, // Belum check-in
                'check_out' => null, // Belum checkout
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($attendances as $attendance) {
            DB::table('attendance')->insert($attendance);
        }
    }
} 