<?php

namespace App\Listeners;

use Log;
use Password;
use Illuminate\Mail\Message;
use App\Events\PasswordMailSendEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordMailSendEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(PasswordMailSendEvent $event)
    {
        $getData = $event->getData();

        $email = ["email" => $getData['email']];
        $subject = $getData['subject'];

        return Password::sendResetLink($email, function (Message $message) use($subject) {
            $message->subject($subject);
        });

    }
}