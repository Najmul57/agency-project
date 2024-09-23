<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaLetter extends Mailable
{
    use Queueable, SerializesModels;

    public $visaletter;
    public $subject;
    public $files;

    /**
     * Create a new message instance.
     */
    public function __construct($visaletter, $subject, $files)
    {
        $this->visaletter = $visaletter;
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
            ->view('admin.email.visaletter')
            ->with(['visaletter' => $this->visaletter]);

        // Attach each file in the $files array
        foreach ($this->files as $file) {
            $mail->attach($file);
        }

        return $mail;
    }
}
