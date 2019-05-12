<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'id' => rand(1000, 9000),
        'description' => 'Title for test minor',
        'minor_id' => function () {
            return factory(App\Minor::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'grade_quality' => round(rand(1, 5)),
        'grade_studiability' => round(rand(1, 5)),
        'grade_content' => round(rand(1, 5)),
        'comment' => $faker->realText(500),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
