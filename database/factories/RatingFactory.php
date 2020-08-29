<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rating;
use App\Models\Book;
use App\Models\User;

use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'book_id' => factory(Book::class),
        'user_id' => factory(User::class),
        'rating' => $faker->numberBetween(3, 5)
    ];
});
