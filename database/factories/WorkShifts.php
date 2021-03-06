<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\WorkShifts;
use Faker\Generator as Faker;

$factory->define(WorkShifts::class, function (Faker $faker) {
    return [
        'form_id' => rand(1,10),
        'time_in' => $faker->time($format = 'H:i:s', $max = 'now'),
        'time_out' => $faker->time($format = 'H:i:s', $max = 'now'),
        'work_desc' => $faker->text,
    ];
});
