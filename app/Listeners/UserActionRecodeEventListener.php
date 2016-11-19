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
        $countType = $event->getCountType();
        $countModel = $event->getPostCountModel();
        $countColumn = $event->getPostCountColumn();
        $recodeModel = $event->getRecodeModelForSave();
        $overlapCheck = $event->getOverlapCheck();

        if( $countType == 'simplex' ){
            if($overlapCheck){
                //count up
                $countModel->$countColumn++;
                $countModel->save();

                //recode write
                $recodeModel->save();
                Log::info('User Action event listen seccess');
                return;
            }
        }
        if($countType == 'toggle'){
            if($overlapCheck){
                //count up
                $countModel->$countColumn++;
                $countModel->save();

                //recode write
                $recodeModel->save();
                Log::info('User Action event listen seccess');
                return;
            }else{
                //count down
                $countModel->$countColumn--;
                $countModel->save();
                // delete recode column
            }
        }
        Log::info('User Action event listen seccess / not recode cuz overlap');
        return;
    }
}
