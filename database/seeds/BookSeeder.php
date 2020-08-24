<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Reply;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = factory(Book::class)->create();

        $comments = $book->comments()->saveMany(
            factory(Comment::class, 10)->make()
        );

        $comments->each(function ($comment) {
            $comment->replies()->saveMany(
                factory(Reply::class, 10)->make()
            );
        });
    }
}
