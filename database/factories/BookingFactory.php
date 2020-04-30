<?php

use Faker\Generator as Faker;

$factory->define(App\Booking::class, function (Faker $faker) {	
    return [       
        'activity' => $faker->activity,
        'place' => $faker->place,
        'date' => $faker->date,
    ];
});
