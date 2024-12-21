<?php
namespace App\Contracts;

interface MailServiceInterface
{
    public function send(string $message,string $view,string $type);
}