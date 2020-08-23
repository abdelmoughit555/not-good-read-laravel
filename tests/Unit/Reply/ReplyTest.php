<?php

namespace Tests\Unit\Reply;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\User;
use App\Models\Comment;

class ReplyTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_belongs_to_a_user()
    {
        $reply = factory(Reply::class)->create();

        $this->assertInstanceOf(User::class, $reply->user);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function  test_it_belongs_to_a_comment()
    {
        $reply = factory(Reply::class)->create();

        $this->assertInstanceOf(Comment::class, $reply->comment);
    }
}
