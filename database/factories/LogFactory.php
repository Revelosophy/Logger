<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Logs;
use Faker\Generator as Faker;

$factory->define(Logs::class, function (Faker $faker) {
    return [
        //
        "text" => $faker->text($maxNbChars=250),
        "user_id" => $faker->randomDigit,
        "likes" => $faker->randomDigit,
        "image_id" => $faker->randomDigit

    ];
});
