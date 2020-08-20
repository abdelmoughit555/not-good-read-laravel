<?php

namespace Tests\Unit\Author;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Quote;
use App\Models\Book;

class AuthorTest extends TestCase
{
    public function test_it_has_many_quotes()
    {
        $author = factory(Author::class)->create();

        $author->quotes()->save(
            factory(Quote::class)->create()
        );

        $this->assertInstanceOf(Quote::class, $author->quotes->first());
    }

    public function test_it_belongs_to_many_books()
    {
        $author = factory(Author::class)->create();

        $author->books()->attach(
            factory(Book::class)->create()
        );

        $this->assertInstanceOf(Book::class, $author->books->first());
    }
}
