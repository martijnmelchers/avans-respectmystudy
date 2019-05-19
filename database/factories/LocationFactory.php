<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    $organisations = \App\Organisation::pluck('id')->toArray();

    return [
        'id' => rand(1, 100),
        'name' => 'Testlocatie',
        'primarylocation' => 1,
        'mailaddress' => 'Teststraat',
        'mailzip' => '1234AB',
        'mailcity' => 'Veldhoven',
        'visitingaddress' => 'Teststraat',
        'visitingzip' => '1234AB',
        'visitingcity' => 'Veldhoven',
        'organisation_id' => $faker->randomElement($organisations),
    ];
});
