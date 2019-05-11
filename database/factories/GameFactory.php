<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'game_name' => $faker->word,
        'game_label' => $faker->word,
        'support_rcon' => $faker->randomElement($array = array (0,1))
    ];
});
