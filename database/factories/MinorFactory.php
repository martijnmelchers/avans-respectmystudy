<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Minor::class, function (Faker $faker) {
    return [
        'id' => rand(1000, 9000),
        'version' => 1,
        'name' => "WordQuest Minor",
        'phonenumber' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'place'=>$faker->city,
        'ects' => array('7.5', '15', '30')[rand(0, 2)],
        'subject'=>$faker->realText(1000),
        'goals' =>$faker->realText(500),
        'requirements'=>$faker->realText(300),
        'examination'=>$faker->realText(200),
        'contact_hours' => rand(10, 40),
        'costs' => rand(1000, 2060),
        'level' =>"BOE",
        'education_type'=> array('HBO', 'WO')[rand(0, 1)],
        'language' => $faker->languageCode,
        'is_published' => true,
        'is_enrollable' =>true,

        'kiesopmaat' => rand(1000, 9000),
        'organisation_id' => 1,
        'location_id' => 1,
        'education_period_id' => 1,
    ];
});
