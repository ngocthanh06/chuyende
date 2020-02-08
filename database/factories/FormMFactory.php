<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FormM;
use Faker\Generator as Faker;

$factory->define(FormM::class, function (Faker $faker) {
    return [
        'FormM_name' => $faker->name,
        'FormM_desc' => $faker->text
    ];
});
