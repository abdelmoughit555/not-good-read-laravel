<?php

namespace Tests\Feature\Reply;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Reply;
use App\Models\User;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ReplyUpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_only_authorized_user_can_update_a_reply()
    {
        $reply = factory(Reply::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $this->json('PATCH', '/api/replies/' . $reply->id . '/comments/' . $reply->comment->id, [
            'text' => $text = $this->faker->text(10)
        ])
            ->assertStatus(403);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_user_can_update_a_reply()
    {
        $reply = factory(Reply::class)->create();

        Sanctum::actingAs(
            $reply->user,
            ['*']
        );

        $this->assertDatabaseHas('replies', ['text' => $reply->text]);

        $this->json('PATCH', '/api/replies/' . $reply->id . '/comments/' . $reply->comment->id, [
            'text' => $text = $this->faker->text(10)
        ])
            ->assertStatus(200);

        $this->assertDatabaseMissing('replies', ['text' => $reply->text]);

        $this->assertDatabaseHas('replies', ['text' => $text]);
    }
}
