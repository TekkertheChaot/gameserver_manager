<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'game_name' => $faker->randomELement($array = array ('Minecraft','Counter-Strike: Global Offensive', 'RUST', 'GTA V', 'Call of Duty: Modern Warfare 3')),
        'game_label' => $faker->word,
        'support_rcon' => $faker->randomElement($array = array (0,1))
    ];
});
