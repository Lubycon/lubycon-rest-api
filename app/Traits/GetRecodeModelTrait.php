<?php
namespace App\Traits;

use App\View;
use App\Donwload;
use App\Like;
// use App\Bookmark;

use App\Content;
use App\Post;
use App\Comment;

trait GetRecodeModelTrait{
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
