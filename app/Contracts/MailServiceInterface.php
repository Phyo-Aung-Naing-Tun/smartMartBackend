<?php

namespace App\Contracts;

interface MailServiceInterface
{
    public function send($receiver, string $message, string $template);
}
