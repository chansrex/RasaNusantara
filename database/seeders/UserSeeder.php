<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        DB::table('users')->insert([
            'name' => 'Admin Restoran',
            'email' => 'admin@restoran.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'language' => 'id',
            'is_accessible_mode' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Customer users
        $customers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('Budi123'),
                'role' => 'customer',
                'language' => 'id',
                'is_accessible_mode' => false,
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@example.com',
                'password' => Hash::make('Siti123'),
                'role' => 'customer',
                'language' => 'en',
                'is_accessible_mode' => true,
            ],
            [
                'name' => 'Dian Purnama',
                'email' => 'dian@example.com',
                'password' => Hash::make('Dian123'),
                'role' => 'customer',
                'language' => 'id',
                'is_accessible_mode' => false,
            ],
        ];

        foreach ($customers as $customer) {
            $customer['created_at'] = now();
            $customer['updated_at'] = now();
            DB::table('users')->insert($customer);
        }
    }
} 