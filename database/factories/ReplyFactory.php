<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Replies;
use Faker\Generator as Faker;

$factory->define(Replies::class, function (Faker $faker) {
    return [
        //
        "text" => $faker->text($maxNbChars = 100),
        "likes" => $faker->randomDigit,
        "author_id" => $faker->randomDigit,
        "target_id" => $faker->randomDigit
    ];
});


