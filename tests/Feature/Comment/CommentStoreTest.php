<?php

namespace Tests\Feature\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Comment;
use Laravel\Sanctum\Sanctum;

class CommentStoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_an_existant_book()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $comment = factory(Comment::class)->raw();

        $this->json('POST', '/api/comments/books/' . 12, $comment)
            ->assertStatus(404);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_requires_a_text()
    {
        Sanctum::actingAs(
            $user = factory(User::class)->create(),
            ['*']
        );

        $book = factory(Book::class)->create();

        $comment = factory(Comment::class)->raw([
            'text' => ''
        ]);

        $this->json('POST', '/api/comments/books/' . $book->id, $comment)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['text']);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_user_can_store_a_comment_related_to_a_book()
    {
        $this->withoutExceptionHandling();

        Sanctum::actingAs(
            $user = factory(User::class)->create(),
            ['*']
        );

        $book = factory(Book::class)->create();

        $comment = factory(Comment::class)->raw([
            'user_id' => $user->id,
            'book_id' => $book->id
        ]);

        $this->assertDatabaseMissing('comments', $comment);

        $this->json('POST', '/api/comments/books/' . $book->id, $comment)
            ->assertStatus(200);

        $this->assertDatabaseHas('comments', $comment);
    }
}
