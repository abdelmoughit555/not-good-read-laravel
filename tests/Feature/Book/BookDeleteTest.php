<?php

namespace Tests\Feature\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_delete_a_book()
    {
        $this->withoutExceptionHandling();

        $book = factory(Book::class)->create();

        $author = factory(Author::class)->create();

        $category = factory(Category::class)->create();


        $this->json('DELETE', '/api/books/' . $book->id);

        $this->assertDatabaseMissing('books', $book->toArray());

        $this->assertDatabaseMissing('author_book', ['author_id' => $author->id]);
        $this->assertDatabaseCount('author_book', 0);

        $this->assertDatabaseMissing('book_category', ['category_id' => $category->id]);
        $this->assertDatabaseCount('book_category', 0);
    }
}
