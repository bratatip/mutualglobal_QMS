<?php

namespace App\Jobs;

use App\Notifications\NotificationToNewUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email , $name, $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $name = $this->name;
        $password = $this->password;
        

        Notification::route('mail', $email)
            ->notify(new NotificationToNewUser($name, $password));
    }
}
