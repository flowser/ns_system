<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserRegistration extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Dear '. $notifiable->full_name .',')
                    ->line('Welcome to our application.')
                    ->action('Visit your Account', url('/auth/dashboard'))
                    ->line('Thank you for registering on our application!')
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
            'name'      => $this->user->name,
            'email'     => $this->user->email,
            'message'   =>  'Thank you For registering on our application!.'
        ];
    }
}
