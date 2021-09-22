<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Camp;
use Faker\Generator as Faker;

$factory->define(Camp::class, function (Faker $faker) {
    // 'location', 'entries', 'cost', 'date'
    return [
        'location'  =>  $faker->address,
        'entries'   =>  rand(5, 10),
        'cost'      =>  rand(1000, 9000),
        'date'      =>  $faker->dateTimeBetween('-1 years', 'now')
    ];
});
