<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employer;
use Faker\Generator as Faker;

$factory->define(Employer::class, function (Faker $faker) {
    return [
        'User_fullname' => $faker->name,
        'Username' => rand(1,100),
        'Birthday' => $faker->date('y-m-d'),
        'sex' => 1,
        'User_add' => $faker->title,
        'User_phone' => rand(1,100),
        'User_bank' => rand(1,100),
        'idComp' => rand(1,10),
    ];
});

