<?php

namespace Tests\Feature\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Enums\AuthorType;

class BookUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_can_update_a_book()
    {
        $this->withoutExceptionHandling();

        $book = factory(Book::class)->create();
        $newBook = factory(Book::class)->raw();

        $author = factory(Author::class)->create();
        $newAuthor = factory(Author::class)->create();

        $category = factory(Category::class)->create();
        $newCategory = factory(Category::class)->create();

        $this->json('PATCH', '/api/books/' . $book->id, array_merge($newBook, [
            'authors' => [
                [
                    'id' => $newAuthor->id,
                    'type' => AuthorType::getRandomKey()
                ]
            ],
            'categories' => (array) $newCategory->id
        ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'authors',
                    'categories'
                ]
            ]);

        $this->assertDatabaseHas('books', $newBook);

        $this->assertDatabaseHas('author_book', ['author_id' => $newAuthor->id]);
        $this->assertDatabaseMissing('author_book', ['author_id' => $author->id]);
        $this->assertDatabaseCount('author_book', 1);

        $this->assertDatabaseHas('book_category', ['category_id' => $newCategory->id]);
        $this->assertDatabaseMissing('book_category', ['category_id' => $category->id]);
        $this->assertDatabaseCount('book_category', 1);
    }
}
