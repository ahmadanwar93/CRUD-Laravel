<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueueEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->email_list = $email_list;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // ,['email_list'=>$this->email_list]
        return $this->view('emails.testQueueMail');
    }
}