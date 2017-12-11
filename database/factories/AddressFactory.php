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

$factory->define(App\Models\Address::class, function (Faker $faker) {
    /** @var \App\Models\County $county */
    $county = factory(\App\Models\County::class)->create();

    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'hint' => $faker->paragraph,
        'province_id' => $county->province_id,
        'county_id' => $county->id
    ];
});
