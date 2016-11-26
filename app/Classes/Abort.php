<?php

namespace App\Classes;

class Abort{

    public static function Error($errorCode){
        $data = config('error.'.$errorCode);
        $error = (object)array(
            "httpCode" => $data->httpCode,
            "code" => $data->customCode,
            "msg" => $data->msg
        );
        Abort::excute($error);
    }
    private static function excute($error){
        throw new \App\Exceptions\CustomException($error->httpCode,$error->code);
    }
}
