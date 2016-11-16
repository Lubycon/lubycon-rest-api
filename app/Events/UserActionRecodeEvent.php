<?php

namespace App\Events;

use Log;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Board;
use App\Content;
use App\Post;
use App\Comment;
use App\View;
use App\Download;
use App\Like;
// use App\Bookmark; not model making yet

use App\Traits\GetUserModelTrait;
use App\Traits\GetRecodeModelTrait;

class UserActionRecodeEvent extends Event
{
    use SerializesModels,
        GetUserModelTrait,
        GetRecodeModelTrait;

    // get data variable
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

    protected $recodeModel;

    public function __construct($type,$data,$request)
    {
        $this->type = $type;
        $this->data = $data;
        $this->request = $request;
        $this->sectorGroup = Board::find($this->data->board_id)->value('group');
        $this->boardId = $this->data->board_id;
        $this->postId = $this->data->id;
        $this->giveUser = $this->getUserByToken($this->request);
        $this->giveUserIp = $_SERVER['REMOTE_ADDR'];
        $this->giveUserId = $this->giveUser->id;
        $this->takeUserId = $this->data->user_id;
        $this->willCheck; //for bookmark like comment_like


        $this->recodeModel = $this->setRecodeModel($this->type);
        $this->recodeModel->give_user_id = 1;
        $this->recodeModel->take_user_id = 1;
        $this->recodeModel->board_id = 1;
        $this->recodeModel->post_id = 1;
        $this->recodeModel->save();
        Log::info($this->recodeModel);

    }
    private function setRecodeModel($type){
        return $this->getRecodeModel($type);
    }
    private function setPostModel(){

    }

    // get data functions
    public function getData(){
        return $this->data;
    }
    public function getRequest(){
        return $this->request;
    }
    public function getSectorGroup(){
        return $this->sectorGroup;
    }
    public function getBoardId(){
        return $this->boardId;
    }
    public function getPostId(){
        return $this->postId;
    }
    public function getGiveUser(){
        return $this->giveUser;
    }
    public function getGiveUserId(){
        return $this->giveUserId;
    }
    public function getGiveUserIp(){
        return $this->giveUserIp;
    }
    public function getTakeUserId(){
        return $this->takeUserId;
    }
    public function getWillCheck(){
        return $this->willCheck;
    }
    // get data functions

    public function broadcastOn()
    {
        return [];
    }
}
