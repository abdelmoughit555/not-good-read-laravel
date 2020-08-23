<?php

namespace Tests\Feature\Reply;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Models\Reply;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Event;
use App\Events\Reply\ReplyCreated;

class ReplyStoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_requires_a_text()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $comment = factory(Comment::class)->create();

        $reply = factory(Reply::class)->raw([
            'text' => ''
        ]);

        $this->json('POST', '/api/replies/comments/' . $comment->id, $reply)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['text']);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_user_can_reply_to_a_comment()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $reply = factory(Reply::class)->raw([
            'comment_id' => $comment = factory(Comment::class)->create(),
            'user_id' => $user =  factory(User::class)->create()
        ]);

        $this->assertDatabaseMissing('replies', $reply);

        Sanctum::actingAs(
            $user,
            ['*']
        );

        $this->json('POST', '/api/replies/comments/' . $comment->id, $reply)
            ->assertStatus(200);

        $this->assertDatabaseHas('replies', $reply);

        $createdReply = Reply::where($reply)->first();

        Event::assertDispatched(function (ReplyCreated $event) use ($createdReply) {
            return $event->reply->id === $createdReply->id;
        });
    }
}
