<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            [
                'user_id' => 2, // Budi
                'message' => 'Pesanan Anda siap untuk diambil. Terima kasih telah memesan di Restoran Kami!',
                'status' => 'read',
                'created_at' => now()->subDays(2)->addMinutes(30),
                'updated_at' => now()->subDays(2)->addMinutes(35),
            ],
            [
                'user_id' => 3, // Siti
                'message' => 'Pesanan Anda sedang diproses. Estimasi waktu tunggu 15 menit.',
                'status' => 'sent',
                'created_at' => now()->subDay()->addMinutes(10),
                'updated_at' => now()->subDay()->addMinutes(10),
            ],
            [
                'user_id' => 4, // Dian
                'message' => 'Terima kasih telah memesan. Pesanan Anda telah diterima dan sedang menunggu untuk diproses.',
                'status' => 'sent',
                'created_at' => now()->addMinutes(5),
                'updated_at' => now()->addMinutes(5),
            ],
            [
                'user_id' => 2, // Budi
                'message' => 'Promo spesial hari ini: Diskon 20% untuk semua menu minuman. Berlaku hingga pukul 17:00.',
                'status' => 'read',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3)->addHours(2),
            ],
            [
                'user_id' => 3, // Siti
                'message' => 'Menu baru tersedia! Coba Rendang spesial kami mulai besok.',
                'status' => 'sent',
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
        ];

        foreach ($notifications as $notification) {
            DB::table('notifications')->insert($notification);
        }
    }
} 