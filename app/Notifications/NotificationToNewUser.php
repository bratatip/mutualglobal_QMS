<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationToNewUser extends Notification
{
    use Queueable;
    protected $name;
    protected $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $password)
    {
        $this -> name = $name;
        $this->password = $password;
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
        $name = $this->name;
        $password = $this->password;
        return (new MailMessage)
            ->line('Hi, ' . $name)
            ->line('Welcome to our application!')
            ->line('You have been registered as a new user.')
            ->line('Your password: ' . $password)
            ->action('Login to Your Account', url('/'))
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
