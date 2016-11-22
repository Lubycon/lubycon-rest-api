<?php
namespace App\Traits;

use App\Models\ContentTag;
use App\Models\ContentCategory;
use App\Models\ContentCategoryKernel;

trait InsertArrayToColumn{
    //array is fure array, dataName is database culumne name
    function InsertContentTagName($array){
        $newArray=[];
        foreach($array as $key => $value){
            $newArray[$key] = new ContentTag(['name'=>$value]);
        }
        return $newArray;
    }
    function InsertContentCategoryId($array){
        $newArray=[];
        foreach($array as $key => $value){
            $newArray[$key] = new ContentCategoryKernel(['category_id'=>$value]);
        }
        return $newArray;
    }
}
 ?>
