<?php
namespace App\Traits;

use App\View;
use App\Donwload;
use App\Like;
// use App\Bookmark;

use App\Content;
use App\Post;
use App\Comment;

use Carbon\Carbon;

use Log;

trait GetRecodeModelTrait{

    private $limitHours = -5;


    function getRecodeModel($type){
        $getClass = $this->findRecodeModel($type);
        return $getClass;
    }
    function findRecodeModel($type){
        switch($type){
            case 'view' :  $class = new View; $this->setViewData($class); break;
            case 'download' :  $class = new Download; $this->setDownloadData($class); break;
            case 'like' :  $class = new Like; $this->setLikeData($class); break;
            default : $class = null ; break;
        }
        return $class;
    }
    function getPostModel($sector){
        switch($sector){
            case 'content' :  $class = new Content ; break;
            case 'post' :  $class = new Post ; break;
            case 'comment' :  $class = new Comment ; break;
            default : $class = null ; break;
        }
        return $class;
    }
    function getPost($model,$postId){
        $post = $model->find($postId);
        return $post;
    }

    function isOverlapCheck($model,$postId){
        $giveUserIdentity = $this->getIdentity();
        $limitTime = Carbon::now($this->limitHours)->toDateTimeString();
        $whereModel = $model->where($giveUserIdentity->column,'=',$giveUserIdentity->value)
                            ->where('created_at','>',$limitTime)
                            ->first();
        return $whereModel !== null ? true : false ;
    }

    function getIdentity(){
        $ipColumnName = 'ipv4';
        $idColumnName = 'give_user_id';
        $userId = $this->getGiveUserId();
        $userIp = $this->getGiveUserIp();
        $result = (object)array();

        if(is_null($userIp)){
            $result->column = $idColumnName;
            $result->value = $userId;
        }else{
            $result->column = $ipColumnName;
            $result->value = $userIp;
        }
        return $result;
    }

    function setViewData($class){
        $class->give_user_id = $this->getGiveUserId();
        $class->take_user_id = $this->getTakeUserId();
        $class->ipv4 = $this->getGiveUserIp();
        $class->board_id = $this->getBoardId();
        $class->post_id = $this->getPostId();
    }
    function setDownloadData($class){
        $class->give_user_id = $this->getGiveUserId();
        $class->take_user_id = $this->getTakeUserId();
        $class->ipv4 = $this->getGiveUserIp();
        $class->board_id = $this->getBoardId();
        $class->post_id = $this->getPostId();
    }
    function setLikeData($class){
        $class->give_user_id = $this->getGiveUserId();
        $class->take_user_id = $this->getTakeUserId();
        $class->board_id = $this->getBoardId();
        $class->post_id = $this->getPostId();
    }
}
 ?>
