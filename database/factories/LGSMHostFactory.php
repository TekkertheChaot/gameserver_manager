<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\LGSMHost;
use Faker\Generator as Faker;

$factory->define(LGSMHost::class, function (Faker $faker) {
    return [
        'ip_adress' => $faker->ipv4
    ];
});
