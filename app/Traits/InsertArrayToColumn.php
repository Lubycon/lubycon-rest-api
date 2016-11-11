<?php
namespace App\Traits;

use App\ContentTag;
use App\ContentCategory;
use App\ContentCategoryKernel;

trait InsertArrayToColumn{
    //array is fure array, dataName is database culumne name
    function InsertContentTagName($array){
        foreach($array as $key => $value){
            $newArray[$key] = new ContentTag(['name'=>$value]);
        }
        return $newArray;
    }
    function InsertContentCategoryId($array){
        foreach($array as $key => $value){
            $newArray[$key] = new ContentCategoryKernel(['category_id'=>$value]);
        }
        return $newArray;
    }
    function convertContentCategoryData($array){
        foreach($array as $key => $value){
            $newArray[$key] = ContentCategory::where('name','=',$value)->value('id');
        }
        return $newArray;
    }
}
 ?>
