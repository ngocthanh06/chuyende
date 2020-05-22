<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ContactM;
use Faker\Generator as Faker;

$factory->define(ContactM::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,10),
        'socical_insurance' => $faker->title,
        'date_start' => $faker->date('y-m-d'),
        'date_end' => $faker->date('y-m-d'),
        'status' => 1,
    ];
});
