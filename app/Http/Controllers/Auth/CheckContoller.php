<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\signup_allow;
use Illuminate\Support\Str;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CheckContoller extends Controller
{
    public static function insertRememberToken($id){
        $user = User::findorfail($id);

        $userId = $user->id;
        $device = 'w';
        $randomStr = Str::random(30);
        $token = $device.$randomStr.$userId; //need change first src from header device kind

        $user->remember_token = $token;
        $user->save();

        return $token;
    }

    public static function insertSignupToken($id){
        $user = User::findorfail($id);

        $recoded = signup_allow::where('email', $user->email);

        if(!is_null($recoded)){
            $recoded->delete();
        }
        $signup = new signup_allow;
        $signup->id = $user->id;
        $signup->email = $user->email;
        $signup->token = Str::random(50);
        $signup->save();
    }

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
