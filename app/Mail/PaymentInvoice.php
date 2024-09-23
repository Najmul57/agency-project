<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use PDF;

class PaymentInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentData; // Define a public property to hold the data

    /**
     * Create a new message instance.
     *
     * @param array $paymentData The data to be passed to the invoice blade file
     */
    public function __construct($paymentData)
    {
        $this->paymentData = $paymentData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $pdf = PDF::loadView('emails.payment.invoice', ['paymentData' => $this->paymentData]);
        // $pdfContent = $pdf->output();

        // $filename = 'payment_invoice_' . uniqid() . '.pdf';
        // Storage::put('public/upload/paymentinvoice/' . $filename, $pdfContent);

        // $this->attachData($pdfContent, $filename, [
        //     'mime' => 'application/pdf',
        // ]);

        // return $this->subject('Payment Invoice')->markdown('emails.payment.invoice');
    }
}
