<?php

namespace Tests\Unit\Author;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Quote;

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
}
