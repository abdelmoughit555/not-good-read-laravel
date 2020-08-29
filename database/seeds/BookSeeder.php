<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Like;

use App\Models\Rating;
use App\Models\User;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Book::class, 10)->create()->each(function ($book) {
            $book->rate(3, $user = factory(User::class)->create());

            $comments = $book->comments()->saveMany(
                factory(Comment::class, 22)->make([
                    'user_id' => $user->id
                ])
            );

            $comments->each(function ($comment) {

                $comment->replies()->saveMany(
                    factory(Reply::class, 10)->make()
                );
            });
        });
    }
}
