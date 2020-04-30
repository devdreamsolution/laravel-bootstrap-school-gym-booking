<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {	
    return [
    	'user_id' => $faker->user_id,
        'activity' => $faker->activity,
        'place' => $faker->place,
        'date' => $faker->date
    ];
});
