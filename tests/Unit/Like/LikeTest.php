<?php

namespace Tests\Unit\Like;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Reply;
use App\Models\User;

class LikeTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_like_can_be_morphed_to_a_comment_model()
    {
        $like = factory(Like::class)->states('comment')->create();

        $this->assertInstanceOf(Comment::class, $like->likeable);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_like_can_be_morphed_to_a_reply_model()
    {
        $like = factory(Like::class)->states('reply')->create();

        $this->assertInstanceOf(Reply::class, $like->likeable);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_a_like_can_belongs_to_a_user()
    {
        $like = factory(Like::class)->create();

        $this->assertInstanceOf(User::class, $like->user);
    }
}
