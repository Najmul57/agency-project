<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdmissionLetter extends Mailable
{
    use Queueable, SerializesModels;
    public $admissionletter;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($admissionletter, $subject)
    {
        $this->admissionletter = $admissionletter;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admission Letter',
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function build()
    {
        return $this->subject('Admission Letter')
            ->view('admin.email.admissionletter')
            ->with('admissionletter', $this->admissionletter);
    }
}
