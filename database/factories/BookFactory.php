<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->text(10),
        'original_title' => $title,
        'edition_language' => $faker->languageCode,
        'slug' => Str::slug($title, '-'),
        'description' => $faker->text(200),
        'isbn' => $faker->isbn13
    ];
});
