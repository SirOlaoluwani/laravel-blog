<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestMoreAboutClient extends Mailable
{
    use Queueable, SerializesModels;
    
    public $client;
    public $emailFrom;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client, $emailFrom)
    {
        //
        $this->client = $client;
        $this->emailFrom = $emailFrom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.request-more-about-client');
    }
}
