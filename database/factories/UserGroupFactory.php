<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User_Group;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User_Group::class, function (Faker $faker) {
    return [
        'user_id' => '1',
        'group_id' => '1'
    ];
});
