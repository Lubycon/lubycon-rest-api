<?php

namespace App\Http\Controllers\Pager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public $request;
    public function __construct(){
    }

    public function setRequest(Request $request){
        $this->request= $request;
    }

    public function index(){
        return var_dump($this->request);
    }
}
