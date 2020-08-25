<?php

namespace Tests\Feature\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class BookRateTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_not_be_rated_by_guest()
    {
        $book = factory(Book::class)->create();

        $this->json('POST', "/api/books/{$book->id}/rate", [
            'rating' => 5
        ])->assertStatus(401);

        $this->assertDatabaseMissing('ratings', ['rating' => 5]);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_book_can_be_rated()
    {
        $this->withoutExceptionHandling();

        $book = factory(Book::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->json('POST', "/api/books/{$book->id}/rate", [
            'rating' => 5
        ]);

        $this->assertDatabaseHas('ratings', ['rating' => 5]);
    }

    public function test_it_can_be_updated_by_users()
    {
        $this->withoutExceptionHandling();

        $book = factory(Book::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->json('POST', "/api/books/{$book->id}/rate", [
            'rating' => 1
        ]);

        $this->assertEquals(1, $book->rating());

        $this->json('POST', "/api/books/{$book->id}/rate", [
            'rating' => 5
        ]);

        $this->assertEquals(5, $book->fresh()->rating());
    }

    public function test_it_required_a_valid_rating()
    {
        $book = factory(Book::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $this->json('POST', "/api/books/{$book->id}/rate")
            ->assertStatus(422)
            ->assertJsonValidationErrors(['rating']);

        $this->json('POST', "/api/books/{$book->id}/rate", [
            'rating' => 'j'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['rating']);
    }
}
