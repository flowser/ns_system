<?php

namespace App\Listeners;

use App\Models\User\User;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //gett all users who are superadmins or admins and notify them on newuser
        $admins = User::role(['Superadmin', 'Admin'])->get(); 
        Notification::send($admins, new NewUserNotification($event->user));
    }
}
