<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'nameComp'=> $faker->name,
        'AddComp' => $faker->name,
        'faxComp' => rand(1,100),
        'phoneComp' => rand(1,100),
        'emailComp' => $faker->email,
        'countComp' => rand(1,100),
    ];
});
