<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
use App\Models\Quote;

class QuoteUpdateTest extends TestCase
{

    public function test_it_can_udate_a_quote()
    {
        $quote = factory(Quote::class)->create([
            'author_id' => factory(Author::class)->create()
        ]);

        $newQuote = factory(Quote::class)->raw([
            'author_id' => $newAuthor = factory(Author::class)->create()
        ]);

        $this->assertDatabaseMissing('quotes', $newQuote);

        $this->json('PATCH', '/api/quotes/' . $quote->id . '/author/' . $newAuthor->id, $newQuote)
            ->assertJsonStructure([
                'data' => [
                    'quote',
                    'author'
                ]
            ]);

        $this->assertDatabaseHas('quotes', $newQuote);
    }
}
