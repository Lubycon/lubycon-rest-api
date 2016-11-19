<?php

namespace App\Events;

use Illuminate\Http\Request;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Board;

use App\Traits\GetUserModelTrait;
use App\Traits\GetRecodeModelTrait;

use Log;

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

    // get data model
    protected $recodeModel;
    protected $postModel;
    protected $post;
    protected $insertData;

    //get overlap check
    protected $overlap;

    public function __construct(Request $request,$type,$data)
    {
        // setting variable
        $this->request = $request->all();
        $this->token = $request->header('X-lubycon-token');
        $this->type = $type;
        $this->data = $data;
        $this->sectorGroup = Board::find($this->data->board_id)->value('group');
        $this->boardId = $this->data->board_id;
        $this->postId = $this->data->id;
        $this->giveUser = $this->getUserByToken($this->token);
        $this->giveUserIp = $request->ip();
        $this->giveUserId = $this->giveUser->id;
        $this->takeUserId = $this->data->user_id;
        $this->willCheck; //for bookmark like comment_like

        // setting model
        $modelInfo = $this->setModel($this->type);
        $this->recodeModel = $modelInfo->model;
        $this->countType = $modelInfo->type;
        $this->postColumn = $modelInfo->column;
        $this->postModel = $this->setPostModel($this->sectorGroup);
        $this->post = $this->setPost($this->postModel,$this->postId);
        $this->overlap = $this->overlapCheck($this->recodeModel,$this->postId);
    }

    // setting model
    private function setModel($type){
        return $this->defineModel($type);
    }
    private function setPostModel($sector){
        return $this->getPostModel($sector);
    }
    private function setPost($model,$postId){
        return $this->getPost($model,$postId);
    }
    private function setCountColumn($type){
        return $this->getCountColumn($type);
    }
    private function overlapCheck($model,$postId){
        return $this->isOverlapCheck($model,$postId);
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
    public function getRecodeModelForSave(){
        return $this->recodeModel;
    }
    public function getOverlapCheck(){
        return $this->overlap;
    }
    public function getPostCountModel(){
        return $this->post;
    }
    public function getPostCountColumn(){
        return $this->postColumn;
    }
    public function getCountType(){
        return $this->countType;
    }

    public function broadcastOn()
    {
        return [];
    }
}
