<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reply;
use App\Models\User;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'comment_id' => factory(Comment::class)->create(),
        'text' => $faker->text(200)
    ];
});
