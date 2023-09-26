<?php

namespace App\Providers;

use App\Events\SendNotificationEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Events\SendMessageNotification;
use App\Events\SendMidnightNotification;
use Illuminate\Auth\Events\PasswordReset;
use App\Listeners\SendNewUserNotification;
use App\Listeners\SendNewUserRegistration;
use App\Listeners\SendNotificationEventListener;
use App\Listeners\SendPasswordResetNotification;
use App\Listeners\SendMessageNotificationListener;
use App\Listeners\SendMidnightNotificationListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendNewUserNotification::class, //notify the admin regarding hte new user registration
            SendNewUserRegistration::class, //notify the user regarding his successfull registration
        ],
        PasswordReset::class => [
            SendPasswordResetNotification::class,
        ],
        SendMessageNotification::class => [
            SendMessageNotificationListener::class,
        ],
        SendMidnightNotification::class => [
            SendMidnightNotificationListener::class,
        ],
        SendNotificationEvent::class => [
            SendNotificationEventListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
