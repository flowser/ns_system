<?php

namespace App\Notifications\Message;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendNotification extends Notification
{
    use Queueable;

    private $user;
    private $email;
    private $notification;
    /**
     * Create the event listener.
     */
    public function __construct($data)
    {
        // dd($data);
        $this->user         = $data->user;
        $this->email        = $data->email;
        $this->notification = $data->notification;
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
                    ->line($this->user->full_name .' has sent a New Notification has been sent on our application.')
                    ->action('Visit Your Account to view the message details', url('/auth/dashboard'))
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
             'name'     => $this->user->name,
            'email'     => $this->user->email,
            'message'   =>  'A new New Notification has been sent.',
        ];
    }
}
