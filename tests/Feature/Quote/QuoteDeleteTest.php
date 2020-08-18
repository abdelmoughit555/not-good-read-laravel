<?php

namespace Tests\Feature\Quote;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Quote;

class QuoteDeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_delete_a_quote()
    {
        $quote = factory(Quote::class)->create([
            'author_id' => $author = factory(Author::class)->create()
        ]);

        $this->assertDatabaseHas('quotes', ['quote' => $quote->quote]);

        $this->json('DELETE', '/api/quotes/' . $quote->id . '/author/' . $author->id)
            ->assertStatus(200);

        $this->assertDatabaseMissing('quotes', ['quote' => $quote->quote]);
    }
}
