<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'Role_name' => $faker->title,
        'Role_desc' => $faker->title,
        'coefficient' => rand(1, 10),
        'price' => rand(10, 100)
    ];
});
