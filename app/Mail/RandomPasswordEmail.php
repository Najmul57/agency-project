<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RandomPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $system_id;
    public $name;
    public $email;
    public $regis__country;
    public $regis__university;
    public $regis__course;
    public $regis__uni__course;


    public function __construct($password, $system_id, $name, $email, $regis__country, $regis__university, $regis__course, $regis__uni__course)
    {
        $this->password = $password;
        $this->system_id = $system_id;
        $this->name = $name;
        $this->email = $email;
        $this->regis__country = $regis__country;
        $this->regis__university = $regis__university;
        $this->regis__course = $regis__course;
        $this->regis__uni__course = $regis__uni__course;
    }

    public function build()
    {
        return $this->view('emails.random_password')->with([
            'password' => $this->password,
            'system_id' => $this->system_id,
            'name' => $this->name,
            'email' => $this->email,
            'regis__country' => $this->regis__country,
            'regis__university' => $this->regis__university,
            'regis__course' => $this->regis__course,
            'regis__uni__course' => $this->regis__uni__course,
        ]);
    }
}
