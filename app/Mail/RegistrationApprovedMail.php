<?php

namespace app\Mail;

use app\Models\RegistrationModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct(RegistrationModels $registration)
    {
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->subject('Your TOEIC Registration Has Been Approved!')
            ->view('emails.registration_approved');
    }
}

