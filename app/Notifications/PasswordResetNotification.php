<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification
{
    use Queueable;
    private $user;
    private $token;
    private $email;
    private $status;
    private $password;
    /**
     * Create the event listener.
     */
    public function __construct($data)
    {
        $this->user    = $data->user;
        $this->token   = $data->token;
        $this->email   = $data->email;
        $this->status  = $data->status;
        $this->password= $data->password;
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
        if($this->status){
            $url = url('/login');
            // dd($url );
            return (new MailMessage)
                    ->subject('Successful Password Change')
                    ->greeting('Dear ' . $this->user->full_name . ',')
                    ->line('You have Successfully Changed your password to: '.$this->password.' ,
                          please click the link below to login to your account.')
                    ->action('Sign in', $url)
                    ->line('Thank you')
                    ->line('Notification Inc Team');
        }else{
            $url = url('/forgotpassword/reset/link/'.$this->user->id .'/'. $this->token);
            // dd($url );
            return (new MailMessage)
                    ->subject('Password Reset Request')
                    ->greeting('Dear ' . $this->user->full_name . ',')
                    ->line('We have received a request to reset your password. If you have made this request,
                          please click the link below to reset your password.')
                    ->action('Reset your Password', $url)
                    ->line('If you did not request a password reset,please ignore this email')
                    ->line('Thank you')
                    ->line('Notification Inc Team');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name'      => $this->user->full_name,
            'email'     => $this->user->email,
            'message'   =>  'Thank you For Successfully Changing your password on our application!.'
        ];
    }
}
