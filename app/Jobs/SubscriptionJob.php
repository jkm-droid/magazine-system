<?php

namespace App\Jobs;

use App\Mail\SendAdminCreationLink;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admin_email, $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin_email, $details)
    {
        $this->admin_email = $admin_email;
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendAdminCreationLink($this->admin_email, $this->details);
        Mail::to($this->admin_email)->send($email);
    }
}
