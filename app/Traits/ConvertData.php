<?php
namespace App\Traits;

use App\ContentTag;
use App\ContentCategory;
use App\ContentCategoryKernel;
use App\License;

trait ConvertData{
    function convertContentCategoryData($array){
        $newArray=[];
        foreach($array as $key => $value){
            $newArray[$key] = ContentCategory::where('name','=',$value)->value('id');
        }
        return $newArray;
    }
    function convertLicenseCodeToId($array){
        $value = (int)$array['by'].(int)$array['nc'].(int)$array['nd'].(int)$array['sa'];
        $newValue = License::where('code','=',$value)->value('id');
        return $newValue;
    }
}
 ?>
