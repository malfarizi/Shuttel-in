<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailTokenRegistration extends Notification
{
    use Queueable;

    private $name;
    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $token)
    {
        $this->name  = $name;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Email Verification Account Shuttle In')
                    ->greeting('Hi '. $this->name)
                    ->line('Please click the button below to verify your email address.')
                    ->action('Verify Email Address', route('user.verify', $this->token))
                    ->line('If you did not create an account, no further action is required.')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
