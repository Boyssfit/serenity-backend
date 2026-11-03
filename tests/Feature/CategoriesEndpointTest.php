<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriesEndpointTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_categories_for_the_frontend(): void
    {
        $category = Category::create(['nama' => 'Pijat & Relaksasi']);

        $this->getJson('/api/categories')
            ->assertOk()
            ->assertJsonPath('data.0.id', $category->id)
            ->assertJsonPath('data.0.nama', $category->nama);
    }
}
