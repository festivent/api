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

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('someSecr3t'),
        'gender' => genders()->random(),
        'birth_at' => \Carbon\Carbon::now()->addYears(
            -1 * (random_int(13, 100))
        )->toDateString(),
        'remember_token' => str_random(10)
    ];
});
