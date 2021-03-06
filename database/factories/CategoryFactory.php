<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->unique()->sentence(),
        'slug' => Str::slug($title, '-')
    ];
});
