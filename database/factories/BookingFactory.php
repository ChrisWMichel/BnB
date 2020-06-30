<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Booking;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
//    $from =  Carbon::instance($faker->dateTimeBetween('-1 months', '+1 months'));
//    $to = (clone $from)->addDays(random_int(1, 14));
//
//    return [
//        'bookables_id' => \App\Models\Bookable::all()->random()->id,
//        'from' => $from,
//        'to' => $to
//    ];

    $from = Carbon::instance($faker->dateTimeBetween('-1 months', '+1 months'));
    $to = (clone $from)->addDays(random_int(0, 14));

    return [
        //'bookables_id' => \App\Models\Bookable::all()->random()->id,
        'from' => $from,
        'to' => $to
    ];
});
