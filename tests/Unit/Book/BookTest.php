<?php

namespace Tests\Unit\Book;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

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
}
