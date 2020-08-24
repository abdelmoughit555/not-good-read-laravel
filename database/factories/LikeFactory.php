<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use App\Models\User;
use App\Models\Reply;
use App\Models\Comment;

use Faker\Generator as Faker;



$factory->define(Like::class, function (Faker $faker) {
    $likeable = [
        Comment::class,
        Reply::class,
    ];
    return [
        'user_id' => factory(User::class),
        'likeable_id' => factory($random = $faker->randomElement($likeable)),
        'likeable_type' => $random
    ];
});

$factory->state(Like::class, 'reply', function ($faker) {
    return [
        'likeable_id' => factory(Reply::class),
        'likeable_type' => 'App\Models\Reply',
    ];
});

$factory->state(Like::class, 'comment', function ($faker) {
    return [
        'likeable_id' => factory(Comment::class),
        'likeable_type' => 'App\Models\Comment',
    ];
});
