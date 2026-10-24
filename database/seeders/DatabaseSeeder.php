<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Serenity',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        $cat1 = Category::create(['nama' => 'Massage & Bodywork']);
        $cat2 = Category::create(['nama' => 'Aromatherapy & Spa']);
        $cat3 = Category::create(['nama' => 'Special Therapy']);

        Service::create([
            'category_id' => $cat1->id,
            'nama' => 'Traditional Bali Massage',
            'deskripsi' => 'Pijat refleksi tubuh mendalam untuk melemaskan kekakuan otot dan melancarkan aliran darah.',
            'harga' => 150000,
            'durasi' => '60 Menit',
            'foto_url' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?q=80&w=600&auto=format&fit=crop',
        ]);

        Service::create([
            'category_id' => $cat2->id,
            'nama' => 'Aromatherapy Relaxation',
            'deskripsi' => 'Pijat lembut menggunakan esensial bunga alami untuk meredakan kecemasan dan stres.',
            'harga' => 220000,
            'durasi' => '90 Menit',
            'foto_url' => 'https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?q=80&w=600&auto=format&fit=crop',
        ]);

        Service::create([
            'category_id' => $cat3->id,
            'nama' => 'Hot Stone Therapy',
            'deskripsi' => 'Terapi batu hangat alami untuk melepaskan ketegangan sendi dan kelelahan kronis.',
            'harga' => 300000,
            'durasi' => '90 Menit',
            'foto_url' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=600&auto=format&fit=crop',
        ]);
    }
}