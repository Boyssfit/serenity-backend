<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate(['id' => 1], ['nama' => 'Pijat & Relaksasi']);
        Category::firstOrCreate(['id' => 2], ['nama' => 'Perawatan Wajah']);
        Category::firstOrCreate(['id' => 3], ['nama' => 'Body Scrub & Lulur']);
    }
}