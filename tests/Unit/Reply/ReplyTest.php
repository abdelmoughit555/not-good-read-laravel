<?php

namespace Tests\Unit\Reply;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Collection;

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

    public function test_it_morph_many_likes()
    {
        $reply = factory(Reply::class)->create();


        $this->assertInstanceOf(Collection::class, $reply->likes);
    }
}
