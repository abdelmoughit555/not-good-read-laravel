<?php

namespace Tests\Feature\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;

class AuthorStoreTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_a_first_name()
    {
        $author = factory(Author::class)->raw([
            'first_name' => ''
        ]);

        $this->json('POST', 'api/authors', $author)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['first_name']);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_a_last_name()
    {
        $author = factory(Author::class)->raw([
            'last_name' => ''
        ]);

        $this->json('POST', 'api/authors', $author)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['last_name']);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_a_bio()
    {
        $author = factory(Author::class)->raw([
            'bio' => ''
        ]);

        $this->json('POST', 'api/authors', $author)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['bio']);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_a_born_in()
    {
        $author = factory(Author::class)->raw([
            'born_in' => ''
        ]);

        $this->json('POST', 'api/authors', $author)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['born_in']);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_a_died_in()
    {
        $author = factory(Author::class)->raw([
            'died_in' => ''
        ]);

        $this->json('POST', 'api/authors', $author)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['died_in']);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_store_an_author()
    {
        $author = factory(Author::class)->raw();

        $this->assertDatabaseMissing('authors', $author);

        $this->json('POST', 'api/authors', $author)
            ->assertStatus(200);

        $this->assertDatabaseHas('authors', $author);
    }
}
