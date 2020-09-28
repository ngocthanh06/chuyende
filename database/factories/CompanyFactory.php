<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'nameComp'=> $faker->name,
        'add_comp' => $faker->name,
        'fax_comp' => rand(1,100),
        'phone_comp' => rand(1,100),
        'email_comp' => $faker->email,
        'count_comp' => rand(1,100),
    ];
});
