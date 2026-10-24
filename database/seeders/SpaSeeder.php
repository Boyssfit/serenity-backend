<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Service;

class SpaSeeder extends Seeder
{
    public function run(): void
    {
        $cat1 = Category::create(['nama_kategori' => 'Traditional Massage']);
        $cat2 = Category::create(['nama_kategori' => 'Aromatherapy & Body Care']);

        Service::create([
            'id_category' => $cat1->id_category,
            'nama' => 'Balinese Deep Tissue Massage',
            'harga' => 150000,
            'durasi' => '60 Menit',
            'deskripsi' => 'Pijat tradisional Bali untuk meredakan ketegangan otot mendalam.',
            'status' => 'Y',
        ]);

        Service::create([
            'id_category' => $cat2->id_category,
            'nama' => 'Lavender Aromatherapy Spa',
            'harga' => 200000,
            'durasi' => '90 Menit',
            'deskripsi' => 'Perawatan tubuh lengkap dengan minyak esensial lavender.',
            'status' => 'Y',
        ]);
    }
}