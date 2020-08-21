<?php

namespace Tests\Feature\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class CommentUpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_only_authorize_user_can_update_its_comment()
    {
        $comment = factory(Comment::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $this->json('PATCH', '/api/comments/' . $comment->id . '/books/' . $comment->book->id, [
            'text' => $this->faker->text(200)
        ])
            ->assertStatus(403);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_user_can_update_a_comment_related_to_a_book()
    {
        $this->withoutExceptionHandling();

        $comment = factory(Comment::class)->create();

        Sanctum::actingAs(
            $comment->user,
            ['*']
        );


        $this->assertDatabaseHas('comments', ['text' => $comment->text]);

        $this->json('PATCH', '/api/comments/' . $comment->id . '/books/' . $comment->book->id, [
            'text' => $text = $this->faker->text(200)
        ])
            ->assertStatus(200);

        $this->assertDatabaseHas('comments', ['text' => $text]);

        $this->assertDatabaseMissing('comments', ['text' => $comment->text]);
    }
}
