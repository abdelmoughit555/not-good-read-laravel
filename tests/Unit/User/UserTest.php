<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;

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
}
