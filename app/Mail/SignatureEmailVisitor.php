<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignatureEmailVisitor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $encryption;
    public function __construct($email,$encryption)
    {
        $this->email = $email;
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
        ->view('email.signature_email_visitor')
        ->subject('SignatureEmail');

    }
}
