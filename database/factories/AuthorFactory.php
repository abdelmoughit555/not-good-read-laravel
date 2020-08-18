<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'bio' => $faker->text(200),
        'born_in' => $faker->date('Y-m-d', 'now'),
        'died_in' => $faker->date('Y-m-d', 'now'),
    ];
});
