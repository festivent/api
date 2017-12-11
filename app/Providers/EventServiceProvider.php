<?php

namespace App\Providers;

use Event;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Auth\Registered' => [
            'App\Listeners\Auth\RegisterListener'
        ],
        'App\Events\Auth\LoggedIn' => [
            'App\Listeners\Auth\LoginListener'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('tymon.jwt.absent', function () {
            throw new AuthenticationException();
        });
    }
}
