<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'gamename' => $faker->word,
        'gamelabel' => $faker->word,
        'supportrcon' => $faker->randomElement($array = array (0,1))
    ];
});
