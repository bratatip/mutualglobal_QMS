<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeleteTempFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pdfPath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Storage::delete($this->pdfPath);
    }
}
