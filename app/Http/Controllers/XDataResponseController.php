<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\job;
use App\country;

use App\post;
use App\PostSort;

// use App\Content;
use App\ContentSort;
use App\ContentCategory;

class DataResponseController extends Controller
{
    private function getModelByWhitelist($query){
        $whiteList = (object)array(
            'user' => User::all(), //only test data
            'job' => job::all(),
            'country' => country::all(),

            'post' => post::all(), //only test data
            'postSort' => PostSort::all(),

            // 'content' => Content::all(), //not builded yet
            'contentSort' => ContentSort::all(),
            'contentCategory' => ContentCategory::all(),
        );
        $models = (object)array();
        foreach($query as $key => $value){
            if(isset($whiteList->$value)){
                $models->$key = $whiteList->$value;
            }else{
                return null;
            }
        };
        return $models;
    }

    public function dataSimpleResponse(Request $request){
        $query = $request->query();
        $models = $this->getModelByWhitelist($query);

        if( !is_null($models) ){
            return response()->success($models);
        }else{
            return response()->error([
                "code" => "0030",
                "devMsg" => "Check WhiteList in Api document!"
            ]);
        }
    }
}
