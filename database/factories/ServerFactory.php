<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Server;
use Faker\Generator as Faker;

$factory->define(Server::class, function (Faker $faker) {
    return [
        'server_name' => 'name:'.$faker->word,
        'game_id' => $faker->randomElement($array = array(1,2,3,4,5)),
        'server_label' => $faker->word,
        'host_id' => $faker->randomELement($array = array(1,2)),
        'credential_id' => $faker->randomELement($array = array(1,2,3,4,5)),        
    ];
});
