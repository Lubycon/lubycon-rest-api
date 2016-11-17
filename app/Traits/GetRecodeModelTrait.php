<?php
namespace App\Traits;

use App\View;
use App\Donwload;
use App\Like;
// use App\Bookmark;

trait GetRecodeModelTrait{
    function getRecodeModel($type){
        $getClass = $this->findRecodeModel($type);
        return $getClass;
    }

    function findRecodeModel($type){
        switch($type){
            case 'view' :  $class = new View ; break;
            case 'download' :  $class = new Download ; break;
            case 'like' :  $class = new Like ; break;
            default : $class = null ; break;
        }
        return $class;
    }

    function getPostModel($sector){
        switch($type){
            case 'content' :  $class = new Content ; break;
            case 'post' :  $class = new Post ; break;
            case 'comment' :  $class = new Comment ; break;
            default : $class = null ; break;
        }
        return $class;
    }
}
 ?>
