<?php
namespace App\Traits;

use App\ContentTag;
use App\ContentCategory;
use App\ContentCategoryKernel;
use App\License;

trait ConvertData{
    function convertContentCategoryIdToName($array){
        $newArray=[];
        foreach($array as $key => $value){
            $newArray[] = ContentCategory::where('id','=',$value->category_id)->value('name');
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
