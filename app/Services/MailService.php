<?php
namespace App\Services;

use App\Contracts\MailServiceInterface;

class MailService implements MailServiceInterface
{
    //$message => the message or otp that you want to send to user
    //$view => the name of view file in resource/views/mail/...
    //$type => otp or sth which is written in config
    
    public function send(string $message,string $view,string $type)
    {
        dump($message);
        dump($view);
        dump($type);
    }
}