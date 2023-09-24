<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewUserRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PasswordResetNotification;

class SendPasswordResetNotification
{
    private $user;
    private $token;
    private $email;
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // dd($event, '$event');
        Notification::send($event->user->user, new PasswordResetNotification($event->user));
    }
}
