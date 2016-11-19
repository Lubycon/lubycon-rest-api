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


    function defineModel($type){
        $getClass = $this->findModel($type);
        return $getClass;
    }
    function findModel($type){
        switch($type){
            case 'view' :
            $class = (object)array(
                'model' => new View,
                'type' => 'simplex',
                'column' => 'view_count'
            ); $this->setViewData($class->model); break;
            case 'download' :
            $class = (object)array(
                'model' => new Download,
                'type' => 'simplex',
                'column' => 'download_count'
            ); $this->setDownloadData($class->model); break;
            case 'like' :
            $class = (object)array(
                'model' => new Like,
                'type' => 'toggle',
                'column' => 'like_count'
            ); $this->setLikeData($class->model); break;
            default : $class = null ; break;
        }
        return $class;
    }

    function getCountColumn($type){
        switch($type){
            case 'view' :  $columnName = 'view_count'; break;
            case 'download' :  $columnName = 'download_count'; break;
            case 'like' :  $columnName = 'like_count'; break;
            default : $columnName = null ; break;
        }
        return $columnName;
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
        $ipColumnName = 'ipv4';
        $idColumnName = 'give_user_id';
        $userId = $this->getGiveUserId();
        $userIp = $this->getGiveUserIp();
        $limitTime = Carbon::now($this->limitHours)->toDateTimeString();

        if($this->countType == 'simplex' ){
            $whereModel = $model->where($ipColumnName,'=',$userIp)
                                ->where('created_at','>',$limitTime)
                                ->first();
            return $whereModel !== null ? true : false ;
        }
        if($this->countType == 'toggle' ){
            $whereModel = $model->where($idColumnName,'=',$userId)
                                ->first();
            return $whereModel !== null ? true : false ;
        }
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
