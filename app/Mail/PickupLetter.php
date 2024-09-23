<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PickupLetter extends Mailable
{
    use Queueable, SerializesModels;

    public $pickupletter;
    public $subject;
    public $files;

    /**
     * Create a new message instance.
     */
    public function __construct($pickupletter, $subject, $files)
    {
        $this->pickupletter = $pickupletter;
        $this->subject = $subject;
        $this->files = is_array($files) ? $files : [$files];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject($this->subject)
            ->view('admin.email.pickupletter')
            ->with(['pickupletter' => $this->pickupletter]);

        // Attach each file in the $files array
        foreach ($this->files as $file) {
            $mail->attach($file);
        }

        return $mail;
    }
}
