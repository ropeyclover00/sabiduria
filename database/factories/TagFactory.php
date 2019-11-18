<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tag::class, function (Faker $faker) {
    $title = $faker->unique()->word(10);
    return [
        "name" => $title,
        "slug" => Str::slug($title),
        "description" => $faker->text(200)
    ];
});
