<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Quote;
use App\Models\Author;
use Faker\Generator as Faker;

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'author_id' => factory(Author::class),
        'quote' => $faker->text(200),
    ];
});
