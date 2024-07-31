<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $msg, $subject;

    public function __construct($message , $subject)
    {
        $this->msg = $message ;
        $this->subject = $subject ;

    }


    public function envelope()
    {
        return new Envelope(
            subject: $this->subject ,
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.MailShape',
        );
    }


    public function attachments()
    {
        return [];
    }
}
