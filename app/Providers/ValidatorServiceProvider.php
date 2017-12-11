<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('password', function ($attribute, $value) {
            return !!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*/', $value);
        });

        Validator::extend('gender', function ($attribute, $value) {
            return genders()->contains($value);
        });

        Validator::extend('telephone', function ($attribute, $value) {
            return !!preg_match(TELEPHONE_REGEX, $value);
        });

        Validator::extend('birth_at', function ($attribute, $value) {
            $diff = Carbon::now()->diff(
                Carbon::createFromTimestamp(
                    strtotime($value)
                )
            );

            return $diff->invert AND $diff->y >= 13 AND $diff->y <= 100;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
