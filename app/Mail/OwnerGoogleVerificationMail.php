<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OwnerGoogleVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Verifikasi Email Akun Owner UMKM')
            ->view('emails.owner_google_verification');
    }
}
