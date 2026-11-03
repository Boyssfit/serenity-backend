<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin Preset (Bawaan)
        User::create([
            'name' => 'Admin Serenity',
            'email' => 'admin@serenity.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Panggil Seeder lain jika ada
        if (class_exists(CategorySeeder::class)) {
            $this->call(CategorySeeder::class);
        }
    }
}