<?php

namespace App\Listeners;

use App\Events\SendOtp;
use App\Events\SuccessfullyRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailToUser
{

    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(SuccessfullyRegister|SendOtp $event): void
    {
        $message = $event?->message;
        $template = $event?->template;
        $receiver = $event?->receiver;
        app("mailService")->send($receiver, $message, $template);
    }
}
