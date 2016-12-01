<?php
namespace App\Traits;

use App\Models\ContentTag;
use App\Models\ContentCategory;
use App\Models\ContentCategoryKernel;
use App\Models\License;
use Abort;

trait ConvertData{
    function convertContentCategoryIdToName($array){
        $newArray=[];
        foreach($array as $key => $value){
            $categoryId = ContentCategory::findOrFail($value->category_id)->value('name');
            $newArray[] = $categoryId;
            if( $categoryId == null ){
                Abort::Error('0040','Unallowed category id');
            }
        }
        return $newArray;
    }
    function convertLicenseCodeToId($array){
        $value = (int)$array['by'].(int)$array['nc'].(int)$array['nd'].(int)$array['sa'];
        $newValue = License::where('code','=',$value)->value('id');
        if( $newValue == null ){
            Abort::Error('0040','Unallowed license combination');
        }
        return $newValue;
    }
}
 ?>
