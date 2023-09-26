<?php

namespace App\Notifications\Message;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendMidnightNotification extends Notification
{
    use Queueable;
use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
        // return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // dd($notifiable, '$notifiable');
        return (new MailMessage)
                    ->line('Dear '. $notifiable->full_name .',')
                    ->line('you have Notifications')
                    ->action('Visit Your Account to view the Notifications', url('/auth/dashboard'))
                    ->line('Thank you')
                    ->line('Notification Inc Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name'      => null,
            'email'     => null,
            'message'   =>  'You have Notifications.',
        ];
    }
}
