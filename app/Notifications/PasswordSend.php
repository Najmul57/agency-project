<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordSend extends Notification
{
    use Queueable;

    public $name;
    public $email;
    public $password;
    public $system_id;
    public $regis__country;
    public $regis__university;
    public $regis__course;
    public $regis__uni__course;

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $email, $password, $system_id, $regis__country, $regis__university, $regis__course, $regis__uni__course)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->system_id = $system_id;
        $this->regis__country = $regis__country;
        $this->regis__university = $regis__university;
        $this->regis__course = $regis__course;
        $this->regis__uni__course = $regis__uni__course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Congratulations! You're Officially Registered with SIAC Abroad.")
            ->markdown('emails.random_password', ['name' => $this->name, 'email' => $this->email, 'password' => $this->password, 'system_id' => $this->system_id, 'regis__country' => $this->regis__country, 'regis__university' => $this->regis__university, 'regis__course' => $this->regis__course, 'regis__uni__course' => $this->regis__uni__course]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
