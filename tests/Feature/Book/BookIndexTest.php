<?php

namespace Tests\Feature\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_can_have_book_index()
    {
        $this->withoutExceptionHandling();

        factory(Book::class, 16)->create()->each(function ($book) {
            $book->authors()->save(factory(Author::class)->make());
            $book->categories()->save(factory(Category::class)->make());
        });

        $this->json('GET', '/api/books')
            ->assertJsonCount(15, 'data')
            ->assertJsonStructure([
                'data',
                'meta'
            ]);
    }
}
