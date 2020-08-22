<?php

namespace Tests\Unit\Book;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;

class BookTest extends TestCase
{
    public function test_it_belongs_to_many_authors()
    {
        $book = factory(Book::class)->create();

        $book->authors()->attach(
            factory(Author::class)->create()
        );

        $this->assertInstanceOf(Author::class, $book->authors->first());
    }

    public function test_it_belongs_to_many_categories()
    {
        $book = factory(Book::class)->create();

        $book->categories()->attach(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $book->categories->first());
    }

    public function test_it_has_many_to_a_book()
    {
        $book = factory(Book::class)->create();

        $book->comments()->save(
            factory(Comment::class)->make()
        );


        $this->assertInstanceOf(Comment::class, $book->comments->first());
    }
}
