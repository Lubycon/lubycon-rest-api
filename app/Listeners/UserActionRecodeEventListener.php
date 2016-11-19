<?php

namespace App\Listeners;

use App\Events\UserActionRecodeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;


class UserActionRecodeEventListener //implements ShouldQueue
{
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  UserActionRecodeEvent  $event
     * @return void
     */
    public function handle(UserActionRecodeEvent $event)
    {
        if( $event->getOverlapCheck() == null ){
            $model = $event->getRecodeModelForSave();
            $model->save();
            Log::info('User Action event listen seccess');
            return;
        }
        Log::info('User Action event listen seccess / not recode cuz overlap');
        return;
    }
}
