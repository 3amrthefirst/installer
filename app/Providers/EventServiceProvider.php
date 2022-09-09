<?php

namespace App\Providers;

use App\Events\JobOrderAcceptedEvent;
use App\Events\JobOrderEvent;
use App\Listeners\SendOrderAcceptEmailListener;
use App\Listeners\SendOrderEmailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        JobOrderEvent::class => [
            SendOrderEmailListener::class,
        ],
        JobOrderAcceptedEvent::class => [
            SendOrderAcceptEmailListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
