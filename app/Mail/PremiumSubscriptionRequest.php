<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PremiumSubscriptionRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $amount;
    public $method;
    public $txt_number;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $amount, $method, $txt_number)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->method = $method;
        $this->txt_number = $txt_number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.premium_subscription_request')
            ->subject('New Premium Subscription Request')
            ->with([
                'user' => $this->user,
                'amount' => $this->amount,
                'method' => $this->method,
                'txt_number' => $this->txt_number,
            ]);
    }
}
