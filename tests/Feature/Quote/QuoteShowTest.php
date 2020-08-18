<?php

namespace Tests\Feature\Quote;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
use App\Models\Quote;

class QuoteShowTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_can_show_a_quote_with_author()
    {
        $quote = factory(Quote::class)->create([
            'author_id' => $author = factory(Author::class)->create()
        ]);

        $this->json('GET', '/api/quotes/' . $quote->id . '/author/' . $author->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'quote',
                    'author'
                ]
            ]);
    }
}
