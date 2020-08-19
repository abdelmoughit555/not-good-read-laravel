<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryStoreTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_can_store_a_category()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->raw();

        $this->assertDatabaseMissing('categories', $category);

        $this->json('POST', '/api/categories', $category)
            ->assertStatus(201)
            ->assertJsonCount(1)
            ->assertJsonStructure([
                'data' => [
                    'slug',
                    'title'
                ]
            ]);

        $this->assertDatabaseHas('categories', $category);
    }
}
