<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Server;
use Faker\Generator as Faker;

$factory->define(Server::class, function (Faker $faker) {
    return [
        'name' => 'name:'.$faker->word,
        'gameid' => $faker->randomElement($array = array(1,2,3,4,5)),
        'label' => $faker->word,
        'hostid' => $faker->randomELement($array = array(1,2)),
        'credid' => $faker->randomELement($array = array(1,2,3,4,5)),        
    ];
});
