<?php

namespace App\Mail;

use App\Models\profile;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePassword extends Mailable
{
    use SerializesModels;

    public $profile;
    public $email;


    public function __construct($profile,$email)
    {
        $this->profile = $profile;
        $this->email = $email;
    }

    public function build()
    {
        return $this->from('CNHS@gmail.com')
        ->subject('Change your Password')
        ->view('emails.ChangePasswordView')
        ->with(['profile' => $this->profile, 'email' =>$this->email]);
    }
}
