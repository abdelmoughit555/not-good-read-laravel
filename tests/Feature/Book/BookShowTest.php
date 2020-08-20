<?php

namespace Tests\Feature\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_show_a_book()
    {
        $book = factory(Book::class)->create();

        $book->each(function ($book) {
            $book->authors()->save(factory(Author::class)->make());
            $book->categories()->save(factory(Category::class)->make());
        });

        $this->json('GET', '/api/books/' . $book->id)
            ->assertJsonCount(1, 'data.authors')
            ->assertJsonCount(1, 'data.categories')
            ->assertJsonStructure([
                'data' => [
                    'authors',
                    'categories'
                ]
            ]);
    }
}
