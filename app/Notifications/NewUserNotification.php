<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
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
                    ->line($this->user->full_name .' has registered successfully to use our application.')
                    ->action('Visit Your Account to view the registration details', url('/auth/dashboard'))
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
            'message'   =>  'A new User has registered successfully.',
        ];
    }
}
