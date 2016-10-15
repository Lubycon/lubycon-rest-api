<?php

namespace App\Listeners;

use Mail;
use Log;
use Auth;
use App\Events\MailSendEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSendEventListener //implements ShouldQueue
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

    /**
     * Handle the event.
     *
     * @param  MailSendEvent  $event
     * @return void
     */
    public function handle(MailSendEvent $event)
    {
        Log::info('mail send start');
        $getData = $event->getData();

        $to = $getData->email;
        $subject = $getData->subject;
        $data = [
            'user' => $getData->user,
            'token' => $getData->token
        ];

        Mail::send("emails.".$getData->type, $data, function($message) use($to, $subject) {
            $message->to($to)->subject($subject);
        });

        Log::info('mail sended');
    }
}
