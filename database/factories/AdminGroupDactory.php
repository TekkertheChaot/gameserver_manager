<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\AdminGroup;
use Faker\Generator as Faker;

$factory->define(AdminGroup::class, function (Faker $faker) {
    return [
        'group_name' => 'admins'
    ];
});
