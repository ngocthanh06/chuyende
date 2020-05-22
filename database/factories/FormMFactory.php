<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FormM;
use Faker\Generator as Faker;

$factory->define(FormM::class, function (Faker $faker) {
    return [
        'FormM_name' => 'Fulltime',
        'FormM_desc' => $faker->text,
        'FormM_Work' => 8,
        'FormM_TimeIn' => $faker->time($format = 'H:i:s', $max = 'now'),
        'FormM_TimeOut' => $faker->time($format = 'H:i:s', $max = 'now'),];
    ;
});

