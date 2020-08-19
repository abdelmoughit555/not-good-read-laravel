<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryUpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_update_a_category()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $newCategoryAttributes = factory(Category::class)->raw();

        $this->json('PUT', '/api/categories/' . $category->id, $newCategoryAttributes)
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $newCategoryAttributes["title"]
            ]);
    }
}
