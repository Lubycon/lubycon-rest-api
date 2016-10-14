<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class dataResponseController extends Controller
{
    public function dataSimpleResponse($id){

        $data = DB::table($id)->get();

        return $data;
    }
}
