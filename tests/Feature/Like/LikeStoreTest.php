<?php

namespace Tests\Feature\Like;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\Reply;
use Laravel\Sanctum\Sanctum;

class LikeStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_store_a_like_on_comment()
    {
        $this->withoutExceptionHandling();

        $comment = factory(Comment::class)->create();

        Sanctum::actingAs(
            $comment->user,
            ['*']
        );

        $this->json('POST', '/api/likes/' . $comment->id, [
            'type' => 'comment'
        ]);

        $this->assertDatabaseCount('likes', 1);

        $this->json('POST', '/api/likes/' . $comment->id, [
            'type' => 'comment'
        ]);

        $this->assertDatabaseCount('likes', 0);
    }

    public function test_it_can_store_a_like_on_reply()
    {
        $this->withoutExceptionHandling();

        $reply = factory(Reply::class)->create();

        Sanctum::actingAs(
            $reply->user,
            ['*']
        );

        $this->json('POST', '/api/likes/' . $reply->id, [
            'type' => 'reply'
        ])
            ->assertStatus(200);

        $this->assertDatabaseCount('likes', 1);

        $this->json('POST', '/api/likes/' . $reply->id, [
            'type' => 'reply'
        ]);

        $this->assertDatabaseCount('likes', 0);
    }
}
