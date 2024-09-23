<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    public $admissionletter;
    public $subject;
    public $filePath;

    /**
     * Create a new message instance.
     *
     * @param array $admissionletter
     * @param string $subject
     * @param string $filePath
     */
    public function __construct($admissionletter, $subject, $filePath)
    {
        $this->admissionletter = $admissionletter;
        $this->subject = $subject;
        $this->filePath = $filePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('admin.email.admissionletter')
            ->attach($this->filePath);
    }
}
