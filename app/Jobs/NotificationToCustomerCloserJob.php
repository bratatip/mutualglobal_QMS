<?php
 
namespace App\Jobs;

use App\Notifications\NotificationToCustomerCloser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotificationToCustomerCloserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    // protected $ccEmails;
    protected $attachmentPaths;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toEmail, $attachmentPath)
    {
        $this->email = $toEmail;
        // $this->ccEmails = $ccEmails;
        $this->attachmentPaths = $attachmentPath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email; // Email address to send the notification to
        // $ccEmails = $this->ccEmails;
        $attachmentPath = $this->attachmentPaths;

        Notification::route('mail', $email)
            ->notify(new NotificationToCustomerCloser($attachmentPath));
    
    }
}
