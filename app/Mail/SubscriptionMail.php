<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin_email, $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin_email, $details)
    {
        $this->admin_email = $admin_email;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.subscription_alert')
            ->from('no-reply@industrialisingafrica.com','industrialisingafrica.com')
            ->subject("New Publication Subscription Alert")
            ->with([
                'email'=>strstr($this->admin_email, '@',true),
                'details'=>$this->details,
            ]);
    }


}
