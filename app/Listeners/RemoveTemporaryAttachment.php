<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RemoveTemporaryAttachment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent  $event)
    {
        Log::info('Listener triggered.');

        // Get the attachment path from the notification
        $attachmentPath = $event->notification->toMail(null)->attachments[0]['path'];
        Log::info('Attachment Path: ' . $attachmentPath);
    
        // Attempt to remove the attachment file
        if (Storage::exists($attachmentPath)) {
            Storage::delete($attachmentPath);
            Log::info('Attachment file deleted.');
        } else {
            Log::info('Attachment file not found.');
        }
    }
}
