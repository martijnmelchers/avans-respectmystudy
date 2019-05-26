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

$factory->define(App\Article::class, function (Faker $faker) {
    $users = \App\User::pluck('id')->toArray();
    
    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
        'author_id' => $faker->randomElement($users),
        'published' => 1,
    ];
});
