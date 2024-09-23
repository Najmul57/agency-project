<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Offerletter extends Mailable
{
    use Queueable, SerializesModels;

    public $offerletter;
    public $subject;
    public $files;

    /**
     * Create a new message instance.
     */
    public function __construct($offerletter, $subject, $files)
    {
        $this->offerletter = $offerletter;
        $this->subject = $subject;
        $this->files = $files;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Request For Offer Letter - ' . $this->offerletter->name,
        );
    }

    public function build()
    {
        $mail = $this->view('admin.email.offerletter', ['offerletter' => $this->offerletter]);
        foreach ($this->files as $file) {
            $mail->attach($file);
        }
        return $mail;
    }
}
