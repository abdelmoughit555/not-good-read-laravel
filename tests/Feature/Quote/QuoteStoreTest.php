<?php

namespace Tests\Feature\Quote;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Quote;
use App\Models\Author;

class QuoteStoreTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_an_author()
    {
        $author = factory(Author::class)->create();

        $quote = factory(Author::class)->raw([
            'author_id' => ''
        ]);

        $this->json('POST', 'api/quotes/' . $author->id, $quote)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['author_id']);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_a_quote()
    {
        $author = factory(Author::class)->create();

        $quote = factory(Author::class)->raw([
            'quote' => ''
        ]);

        $this->json('POST', 'api/quotes/' . $author->id, $quote)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['quote']);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_can_store_a_quote()
    {
        $author = factory(Author::class)->create();

        $quote = factory(Quote::class)->raw([
            'author_id' => $author->id
        ]);

        $this->assertDatabaseMissing('quotes', $quote);

        $this->json('POST', 'api/quotes/' . $author->id, $quote)
            ->assertStatus(200);

        $this->assertDatabaseHas('quotes', $quote);
    }
}
