<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationToInsurerConvert extends Notification
{
    use Queueable;
    protected $attachment;
    protected $ccEmails;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($attachment, $ccEmails)
    {
        $this->attachment = $attachment;
        $this->ccEmails = $ccEmails;
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
        $attachmentPath = $this->attachment;
        $ccEmails = $this->ccEmails;
        // return (new MailMessage)
        //     ->cc($ccEmails)
        //     ->line('The introduction to the notification.')
        //     ->action('Notification Action', url('/'))
        //     ->line('Thank you for using our application!')
        //     ->attach(storage_path('app/' . $attachmentPath));

 
        $message = (new MailMessage)
            ->cc($ccEmails)
            ->line('The introduction to the notification.');
            // ->action('Notification Action', url('/'));

        foreach ($attachmentPath as $attachmentPath) {
            $message->attach(storage_path('app/' . $attachmentPath));
        }

        $message->line('Thank you for using our application.');

        return $message;
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