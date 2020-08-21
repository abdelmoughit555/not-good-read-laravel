<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\User;
use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'book_id' => factory(Book::class),
        'text' => $this->faker->text(200),
    ];
});
