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

$factory->define(App\Models\Organizer::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'telephone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'user_id' => factory(App\Models\User::class)->create()->id
    ];
});
