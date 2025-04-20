<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user admin default
        User::create([
            'name' => 'Admin',
            'email' => 'admin@rasanusantara.id',
            'role' => 'admin',
            'password' => Hash::make('admin123'), // Password default: admin123
        ]);
    }
} 