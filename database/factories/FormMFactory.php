<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FormM;
use Faker\Generator as Faker;

$factory->define(FormM::class, function (Faker $faker) {
    return [
        'form_name' => 'Fulltime',
        'form_desc' => $faker->text,
        'form_work' => 8,
        'form_time_in' => $faker->time($format = 'H:i:s', $max = 'now'),
        'form_time_out' => $faker->time($format = 'H:i:s', $max = 'now'),];
    ;
});

