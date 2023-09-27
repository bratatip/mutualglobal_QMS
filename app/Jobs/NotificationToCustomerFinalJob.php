<?php

namespace App\Jobs;

use App\Notifications\NotificationToCustomerFinal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotificationToCustomerFinalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $attachmentPaths;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toEmail, $attachmentPath)
    {
        $this->email = $toEmail;
        $this->attachmentPaths = $attachmentPath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email; 
        $attachmentPath = $this->attachmentPaths;

        Notification::route('mail', $email)
        ->notify(new NotificationToCustomerFinal($attachmentPath));
    }
}
