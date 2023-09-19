<?php

namespace App\Jobs;

use App\Notifications\NotificationToInsurerConvert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotificationToInsurerConvertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $ccEmails;
    protected $attachmentPaths;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toEmail, $ccEmails, $attachmentPaths)
    {
        $this->email = $toEmail;
        $this->ccEmails = $ccEmails;
        $this->attachmentPaths = $attachmentPaths;
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
        $attachmentPath = $this->attachmentPaths;

        Notification::route('mail', $email)
            ->notify(new NotificationToInsurerConvert($attachmentPath , $ccEmails));
    
    }
}
