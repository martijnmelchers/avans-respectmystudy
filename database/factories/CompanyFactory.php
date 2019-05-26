<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    $users = \App\Users::pluck('id')->toArray();
    return [
        'id' => rand(0, 100),
        'user_id' => $faker->randomElement($users),
        'company_name' => 'Testing bv.',
        'location' => 'Nijmegen',
        'company_description' => 'Testing BV voor al uw testing needs.',
        'extra_information' => 'Testing BV voor al uw testing needs but then extra.',
        'created_at' => now(),
        'updated_at' => now()
    ];
});
