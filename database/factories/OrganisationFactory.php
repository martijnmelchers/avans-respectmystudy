<?php

use Faker\Generator as Faker;

$factory->define(App\Organisation::class, function (Faker $faker) {
    return [
        'id' => rand(0, 100),
        'name' => 'Testorganisatie',
        'abbreviation' => 'TO',
        'type' => 'HBO',
        'participates' => 1
    ];
});
