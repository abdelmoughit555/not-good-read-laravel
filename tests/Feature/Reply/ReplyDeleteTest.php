<?php

namespace Tests\Feature\Reply;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Reply;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class ReplyDeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_only_authorize_user_can_delete_a_reply()
    {
        $reply = factory(Reply::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $this->json('DELETE', '/api/replies/' . $reply->id . '/comments/' . $reply->fresh()->comment->id)
            ->assertStatus(403);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_user_can_delete_a_reply()
    {
        $reply = factory(Reply::class)->create();

        Sanctum::actingAs(
            $reply->fresh()->user,
            ['*']
        );
        $this->assertDatabaseHas('replies', $reply->toArray());

        $this->json('DELETE', '/api/replies/' . $reply->id . '/comments/' . $reply->fresh()->comment->id)
            ->assertStatus(200);

        $this->assertDatabaseMissing('replies', $reply->toArray());
    }
}
