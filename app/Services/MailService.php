<?php

namespace App\Services;

use App\Contracts\MailServiceInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralMail;

class MailService implements MailServiceInterface
{
    //$message => the message or otp that you want to send to user
    //$template => the name of view file in resource/views/mail/...

    public function send($receiver, string $message, string $template)
    {
        try {
            Mail::to($receiver)->send(new GeneralMail($message, $template));
        } catch (\Throwable $e) {
            logger(["mailtest", $e->getMessage()]);
        }
    }
}
