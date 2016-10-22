<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class dataResponseController extends Controller
{
    protected $whiteList = ['jobs','countries','users'];

    public function dataSimpleResponse($id){

        $data = $this->getDataFromDatabase($id);

        if( !is_null($data) ){
            return response()->success($data);
        }else{
            return response()->error([
                "code" => "0030"
            ]);
        }
    }

    private function getDataFromDatabase($id){
        $validate = in_array($id,$this->whiteList);

        if($validate){
            return DB::table($id)->get();
        }
    }
}
