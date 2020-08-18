<?php

namespace Tests\Unit\Quote;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Quote;

class QuoteTest extends TestCase
{
    public function test_it_belongs_to_an_author()
    {
        $quote = factory(Quote::class)->create();

        $this->assertInstanceOf(Author::class, $quote->author);
    }
}
