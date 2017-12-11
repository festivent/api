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

$factory->define(App\Models\Event::class, function (Faker $faker) {
    $attributes = [
        'title' => $faker->title,
        'description' => $faker->paragraph,
        'started_at' => \Carbon\Carbon::now()->addDays(random_int(1, 30)),
        'address_id' => factory(\App\Models\Address::class)->create()->id
    ];

    if (app()->environment() == 'testing') {
        $attributes['key'] = str_random(31);
        $attributes['image'] = 'images/sample.jpg';
    } else {
        $attributes['image'] = str_replace(
            storage_path() . DIRECTORY_SEPARATOR, '', $faker->image(storage_path('images'))
        );
    }

    return $attributes;
});
