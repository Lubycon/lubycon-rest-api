<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class Abort{

  public function Error($errorCode){
      config('error.'.$errorCode);
  }

  public function excute($code, $msg){
    abort($code, $msg);
  }

}
