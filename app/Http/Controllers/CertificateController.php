<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\CheckContoller;
use Auth;
use Carbon\Carbon;
use App\User;
use App\signup_allow;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function __construct()
    {
        $user;
    }

    protected function certToken(Request $request){
        $token = $request->header('X-lubycon-token');
        $this->user = User::where('remember_token','=',$token)->get();

        if(!$this->user->isempty()){
            $result = (object)array(
                "validity" => true
            );
            return response()->success($result);
        }else{
            $result = (object)array(
                "validity" => false
            );
            return response()->success($result);
        }
    }
    protected function certTokenTimeCheck(Request $request){
        $data = CheckContoller::checkToken($request);

        $createTime = signup_allow::find($data->id)->created_at;
        $hours = 6;
        $diffTime = $this->checkDiffTime($createTime,$hours);

        return response()->success([
            "time" => $diffTime
        ]);
    }

    protected function checkDiffTime($createTime,$hours){
        $startTime = Carbon::now();
        $endTime = $createTime->addhours($hours);

        if($startTime > $endTime){
            return 0;
        }
        return $startTime->diffInSeconds($endTime);
    }

    protected function certSignupToken(Request $request){
        $data = CheckContoller::checkToken($request);
        $code = $request->only('code');
        $user = User::find($data->id);

        $validateToken = signup_allow::whereRaw("email = '".$user->email."' and token = '".$code['code']."'")->get();

        if(!$validateToken->isempty()){
            $this->activeUser($user);
            $validateToken[0]->delete();

            return response()->success([
                "validity" => true
            ]);
        }
        return response()->success([
            "validity" => false
        ]);
    }

    protected function certPassword(Request $request){
        $data = $request->json()->all();

        $credentials = [
            'email'    => $data['email'],
            'password' => $data['password'],
            'remember_token' => $request->header('X-lubycon-token')
        ];

        if (Auth::attempt($credentials)) {
            $result = (object)array(
                "validity" => true
            );
            return response()->success($result);
        }
        $result = (object)array(
            "validity" => false
        );
        return response()->success($result);
    }

    protected function activeUser($user){
        $user->is_active = 'active';
        $user->save();
    }
}
