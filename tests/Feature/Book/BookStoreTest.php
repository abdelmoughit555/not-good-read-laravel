<?php

namespace Tests\Feature\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Enums\AuthorType;
use App\User;
use Laravel\Sanctum\Sanctum;

class BookStoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_can_store_a_book()
    {
        $this->withoutExceptionHandling();

        $book = factory(Book::class)->raw();

        $author = factory(Author::class)->create();

        $category = factory(Category::class)->create();

        $this->assertDatabaseMissing('books', $book);

        $this->json('POST', '/api/books', array_merge($book, [
            'authors' => [
                [
                    'id' => $author->id,
                    'type' => AuthorType::getRandomKey()
                ]
            ],
            'categories' => (array) $category->id
        ]))
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'authors',
                    'categories'
                ]
            ]);

        $this->assertDatabaseHas('books', $book);

        $this->assertDatabaseHas('author_book', ['author_id' => $author->id]);
        $this->assertDatabaseCount('author_book', 1);

        $this->assertDatabaseHas('book_category', ['category_id' => $category->id]);
        $this->assertDatabaseCount('book_category', 1);
    }
}
