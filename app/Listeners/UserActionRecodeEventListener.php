<?php

namespace App\Listeners;

use App\Events\UserActionRecodeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;


class UserActionRecodeEventListener// implements ShouldQueue
{
    public function __construct()
    {
        Log::info('UserAction Event Listener Construct');
    }

    /**
     * Handle the event.
     *
     * @param  UserActionRecodeEvent  $event
     * @return void
     */
    public function handle(UserActionRecodeEvent $event)
    {
        // Log::info($event->getGiveUserId());
    }
}
