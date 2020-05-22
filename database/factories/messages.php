<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\messages;
use Faker\Generator as Faker;

$factory->define(messages::class, function (Faker $faker) {
    do{
        $from = rand(1, 15);
        $to = rand(1,15);
    }
    while($from === $to);
    return [
        'from' => $from,
        'to' => $to,
        'text' => $faker->sentence,
    ];
});
