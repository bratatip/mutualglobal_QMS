<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\AttachmentNotification;
use App\Notifications\NotificationToInsurer;
use Illuminate\Support\Facades\Notification;
 

class NotificationToInsurerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $ccEmails;
    protected $emailSubject;
    protected $emailBody;
    protected $attachmentPath; 


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toEmail, $ccEmails,$emailSubject,$emailBody, $attachmentPath)
    {
        $this->email = $toEmail;
        $this->ccEmails = $ccEmails;
        $this->emailSubject = $emailSubject;
        $this->emailBody = $emailBody;
        $this->attachmentPath = $attachmentPath;
    }
 
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email; // Email address to send the notification to
        $ccEmails = $this->ccEmails;
        $emailSubject = $this->emailSubject;
        $emailBody = $this->emailBody;
        $attachmentPath = $this->attachmentPath;

        Notification::route('mail', $email)
            ->notify(new NotificationToInsurer($attachmentPath , $ccEmails, $emailSubject, $emailBody));
    }
}
