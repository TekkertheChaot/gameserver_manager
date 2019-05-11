<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Privilege;
use Faker\Generator as Faker;

$factory->define(Privilege::class, function (Faker $faker) {
    return [
        'serverid' => $faker->randomElement($array = array (1,2,3,4,5)),
        'lgsmstart' => $faker->randomElement($array = array (0,1)),
        'lgsmrestart' => $faker->randomElement($array = array (0,1)),
        'lgsmstop' => $faker->randomElement($array = array (0,1)),
        'lgsmupdate' => $faker->randomElement($array = array (0,1)),
        'lgsmstatus' => $faker->randomElement($array = array (0,1)),
        'viewindash' => $faker->randomElement($array = array (0,1))
    ];
});