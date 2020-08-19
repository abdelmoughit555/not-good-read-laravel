<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_delete_a_category()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $this->assertDatabaseHas('categories', $category->toArray());

        $this->json('DELETE', '/api/categories/' . $category->id)
            ->assertStatus(200);

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
