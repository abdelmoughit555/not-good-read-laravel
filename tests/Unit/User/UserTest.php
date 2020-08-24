<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_many_comments()
    {
        $user = factory(User::class)->create();

        $user->comments()->save(
            factory(Comment::class)->make()
        );

        $this->assertInstanceOf(Comment::class, $user->comments->first());
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_has_many_likes()
    {
        $user = factory(User::class)->create();

        $like = factory(Like::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf(Like::class, $user->likes->first());
    }
}
