<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryShowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_show_a_category()
    {
        $category = factory(Category::class)->create();

        $this->json('GET', '/api/categories/' . $category->id)
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $category->title
            ]);
    }
}
