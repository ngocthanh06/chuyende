<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employer;
use Faker\Generator as Faker;

$factory->define(Employer::class, function (Faker $faker) {
    return [
        'user_fullname' => $faker->name,
        'username' => rand(1,100),
        'birthday' => $faker->date('y-m-d'),
        'sex' => 1,
        'role_id' => 1,
        'user_add' => $faker->title,
        'user_phone' => rand(1,100),
        'user_bank' => rand(1,100),
        'idComp' => rand(1,10),
    ];
});

