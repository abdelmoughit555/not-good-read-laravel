<?php

namespace Tests\Feature\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\User;
use App\Models\Reply;
use Laravel\Sanctum\Sanctum;

class CommentDeleteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_only_authorize_user_can_delete_its_comment()
    {
        $comment = factory(Comment::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $this->json('DELETE', '/api/comments/' . $comment->id)
            ->assertStatus(403);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_user_can_delete_a_comment()
    {
        $comment = factory(Comment::class)->create();

        Sanctum::actingAs(
            $comment->user,
            ['*']
        );

        $this->assertDatabaseHas('comments', ['text' => $comment->text]);

        $this->json('DELETE', '/api/comments/' . $comment->id)
            ->assertStatus(200);

        $this->assertDatabaseMissing('comments', ['text' => $comment->text]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_delete_all_replies_when_delete_a_comment()
    {
        $comment = factory(Comment::class)->create();

        $reply = $comment->replies()->save(
            factory(Reply::class)->make()
        );

        Sanctum::actingAs(
            $comment->user,
            ['*']
        );

        $this->assertDatabaseHas('replies', $reply->toArray());

        $this->json('DELETE', '/api/comments/' . $comment->id)
            ->assertStatus(200);

        $this->assertDatabaseMissing('replies', $reply->toArray());
    }
}
