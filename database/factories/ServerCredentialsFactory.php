<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ServerCredentials;
use Faker\Generator as Faker;

$factory->define(ServerCredentials::class, function (Faker $faker) {
    return [
        'hostid' => $faker->randomElement($array = array (1,2)),
        'user' => $faker->word,
        'password' => $faker->word,
    ];
});
