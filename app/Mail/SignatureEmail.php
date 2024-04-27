<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignatureEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $client;
    public $encryption;
    public function __construct($client,$encryption)
    {
        $this->client = $client;
        $this->encryption = $encryption;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('hello@getsign.net')
        ->view('email.signature_email')
        ->subject('SignatureEmail');

    }
}
