<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;

use App\Models\Board;

use App\Traits\GetUserModelTrait;
use App\Traits\GetRecodeModelTrait;

use Log;

class UserActionRecodeJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels, GetUserModelTrait, GetRecodeModelTrait;

    protected $type;
    protected $data;
    protected $request;
    protected $sectorGroup;
    protected $boardId;
    protected $postId;
    protected $giveUser;
    protected $giveUserIp;
    protected $giveUserId;
    protected $takeUserId;
    protected $willCheck;

    // get data model
    protected $recodeModel;
    protected $countType;
    protected $postColumn;
    protected $postModel;
    protected $post;
    protected $insertData;

    //get overlap check
    protected $overlap;


    public function __construct()
    {
        // // setting variable
        // $this->request = $request->all();
        // $this->token = $request->header('X-lubycon-token');
        // $this->type = $type;
        // $this->data = $data;
        // $this->sectorGroup = Board::find($this->data->board_id)->value('group');
        // $this->boardId = $this->data->board_id;
        // $this->postId = $this->data->id;
        // $this->giveUser = $this->getUserByToken($this->token);
        // $this->giveUserIp = $request->ip();
        // $this->giveUserId = is_null($this->giveUser) ? null : $this->giveUser->id ;
        // $this->takeUserId = $this->data->user_id;
        // $this->willCheck; //for bookmark like comment_like
        // // setting model
        // $modelInfo = $this->setModel($this->type);
        // $this->recodeModel = $modelInfo->model;
        // $this->countType = $modelInfo->type;
        // $this->postColumn = $modelInfo->column;
        // $this->postModel = $this->setPostModel($this->sectorGroup);
        // $this->post = $this->setPost($this->postModel,$this->postId);
        // $this->overlap = $this->overlapCheck($this->recodeModel,$this->postId);
    }


    // setting model
    // private function setModel($type){
    //     return $this->defineModel($type);
    // }
    // private function setPostModel($sector){
    //     return $this->getPostModel($sector);
    // }
    // private function setPost($model,$postId){
    //     return $this->getPost($model,$postId);
    // }
    // private function setCountColumn($type){
    //     return $this->getCountColumn($type);
    // }
    // private function overlapCheck($model,$postId){
    //     return $this->isOverlapCheck($model,$postId);
    // }


    public function handle()
    {
    Log::info('User Action event listen seccess / not recode cuz overlap');
        $countColumn = $this->postColumn;
        if( $this->countType == 'simplex' ){
            if($this->overlap){
                //count up
                $this->post->$countColumn++;
                $this->post->save();

                //recode write
                $this->recodeModel->save();
                Log::info('User Action event listen seccess');
                return;
            }
        }
        if($this->countType == 'toggle'){
            if($this->overlap){
                //count up
                $this->post->$countColumn++;
                $this->post->save();

                //recode write
                $this->recodeModel->save();
                Log::info('User Action event listen seccess');
                return;
            }else{
                //count down
                $this->post->$countColumn--;
                $this->post->save();
                // delete recode column
            }
        }
        Log::info('User Action event listen seccess / not recode cuz overlap');
        return;
    }
}
