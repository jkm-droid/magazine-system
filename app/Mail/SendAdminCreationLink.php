<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAdminCreationLink extends Mailable
{
    use Queueable, SerializesModels;

    public $admin_email, $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin_email, $link)
    {
        $this->admin_email = $admin_email;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.admin_creation')
            ->from('info@industrialisingafrica.com','industrialisingafrica.com')
            ->subject("Invitation to become an Admin")
            ->with([
                'email'=>$this->admin_email,
                'link'=>$this->link,
            ]);
    }
}
