<?php
namespace App\Traits;

use App\View;
use App\Donwload;
use App\Like;
use App\Bookmark;

trait GetRecodeModelTrait{
    function getRecodeModel($type){
        $getClass = $this->findRecodeModel($type);
        return $getClass;
    }

    function findRecodeModel($type){
        switch($type){
            case 'view' :  $class = new View ; break;
            default : $class = null ; break;
        }
        return $class;
    }
}
 ?>
