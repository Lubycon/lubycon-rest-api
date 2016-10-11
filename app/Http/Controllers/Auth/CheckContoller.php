<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CheckContoller extends Controller
{
    public static function checkToken($request){
        $token = $request->header('X-lubycon-token');
        $tokenData = (object)array(
            "device" => substr($token, 0, 1),
            "token" => substr($token, 1, 30),
            "id" => substr($token, 31),
        );
        return $tokenData;
    }

    public static function checkUserExistById($id){
        $user=User::find($id);
        if (!is_null($user)) {
            return true;
        }
        return false;
    }

    public static function checkUserExistByIdOnlyTrashed($id)
    {
        $user = User::onlyTrashed()->find($id);
        if (!is_null($user)) {
            return true;
        }
        return false;
    }

    public static function checkUserExistByEmail($data){
        $user = User::whereRaw("email = '".$data['email']."' and sns_code = ".$data['snsCode'])->get();
        if(!$user->isempty()) {
            return true;
        }
        return false;
    }
}
