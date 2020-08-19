<?php

namespace Tests\Feature\Book;

use Tests\TestCase;
use App\Models\Book;

class BookStoreTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_can_store_a_book()
    {
        $this->withoutExceptionHandling();

        $book = factory(Book::class)->raw();

        $this->assertDatabaseMissing('books', $book);

        $this->json('POST', '/api/books', $book)
            ->assertStatus(201);

        $this->assertDatabaseHas('books', $book);
    }
}
