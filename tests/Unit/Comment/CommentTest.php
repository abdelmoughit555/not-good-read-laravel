<?php

namespace Tests\Unit\Comment;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Comment;
use App\Models\Reply;

class CommentTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_belongs_to_a_book()
    {
        $comment = factory(Comment::class)->create();

        $this->assertInstanceOf(Book::class, $comment->book);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_belongs_to_a_user()
    {
        $comment = factory(Comment::class)->create();

        $this->assertInstanceOf(User::class, $comment->user);
    }

    public function test_it_has_many_replies()
    {
        $comment = factory(Comment::class)->create();

        $comment->replies()->save(
            factory(Reply::class)->create()
        );

        $this->assertInstanceOf(Reply::class, $comment->replies->first());
    }
}
