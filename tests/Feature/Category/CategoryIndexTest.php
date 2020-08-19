<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_shows_all_categories()
    {
        $categories = factory(Category::class, 3)->create();

        $this->json('GET', '/api/categories')
            ->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonFragment([
                'title' => $categories[0]->title
            ]);
    }
}
