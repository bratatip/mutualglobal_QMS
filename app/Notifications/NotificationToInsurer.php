<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationToInsurer extends Notification
{
    use Queueable;
    protected $attachment;
    protected $ccEmails;
    protected $emailSubject;
    protected $emailBody;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($attachment, $ccEmails, $emailSubject, $emailBody)
    {
        $this->attachment = $attachment;
        $this->ccEmails = $ccEmails;
        $this->emailSubject = $emailSubject;
        $this->emailBody = $emailBody;
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
        // $subject = !empty($this->emailSubject) ? $this->emailSubject : 'Default Subject';

        $attachmentPath = $this->attachment;
        $ccEmails = $this->ccEmails;
        $emailSubject = $this->emailSubject;
        $emailBody = $this->emailBody;

        // $greeting = 'Dear Sir & Madam,';
        // $introLines = [
        //     'Greetings from Mutual Global !',
        //     '',
        //     'We would like to thank you for sharing the details to participate in the Insurance program. Further reference to the provided details kindly find the attached quote details',
        //     '',
        //     'Hope you will find this in order',
        //     '',
        //     'Note: This is a system-generated Quote Cum Proposal; For any further details kindly reach out to our RM',
        // ];

        // $signature = 'Thanks & Regards,';
        // $signature .= PHP_EOL;
        // $signature .= 'Mutual Global Insurance Broking Pvt Ltd';
        // $signature .= PHP_EOL;
        // $signature .= '(Licence No : 752, Licence period 01/07/2021 to 30/06/2024)';
        // $signature .= PHP_EOL;
        // $signature .= '2nd Floor, 16/1, AVS Compound, 80ft Road, 4th Block, Koramangala, Bangalore 560034.';
        // $signature .= PHP_EOL;
        // $signature .= 'Customer care number : 9620960093';
        // $signature .= PHP_EOL;
        // $signature .= 'An ISO Certified Company (ISO 9001:2015 Certificate No 22IQKS27)';
        // return (new MailMessage)
        //     ->cc($ccEmails)
        //     ->from('mutualglobal@gmail.com', 'Barrett Blair')
        //     ->subject($emailSubject)
        //     ->line($greeting)
        //     ->line($introLines)
        //     ->line($signature)
        //     ->attach(storage_path('app/' . $attachmentPath));

        return (new MailMessage)
        ->cc($ccEmails)
        ->from('mutualglobal@gmail.com', 'Barrett Blair')
        ->subject($emailSubject)
        ->markdown('admin.email.custom_notification', [
            'emailBody' => $this->emailBody,
            ])
        // ->markdown('admin.email.custom_notification_markdown', [
        //     'emailBody' => $this->emailBody,
        // ])
        ->attach(storage_path('app/' . $attachmentPath));
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
