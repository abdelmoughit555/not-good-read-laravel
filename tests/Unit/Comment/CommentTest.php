<?php

namespace Tests\Unit\Comment;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Comment;

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
}
