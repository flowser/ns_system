<?php

namespace App\Listeners;

use App\Models\User\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Message\MessageNotification;

class SendMessageNotificationListener
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
        $admins = User::role(['Superadmin', 'Admin'])->get();
        Notification::send($admins, new MessageNotification($event->data));
    }
}
