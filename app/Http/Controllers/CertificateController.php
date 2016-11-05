<?php

namespace App\Http\Controllers;

use DB;
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
            return response()->success([
                "validity" => true
            ]);
        }else{
            return response()->error([
                "validity" => false
            ]);
        }
    }
    protected function certTokenTimeCheck(Request $request){
        $data = CheckContoller::checkToken($request);

        $createTime = signup_allow::find($data->id)->created_at;
        $minutes = 360;
        $diffTime = $this->checkDiffTime($createTime,$minutes);

        return response()->success([
            "time" => $diffTime
        ]);
    }

    protected function certPasswordTimeCheck(Request $request){
        $data = $request->json()->all();

        $createTime = new Carbon(DB::table('password_resets')->where('email','=',$data['email'])->value('created_at'));

        $minutes = 30;
        $diffTime = $this->checkDiffTime($createTime,$minutes);

        return response()->success([
            "time" => $diffTime
        ]);
    }

    protected function checkDiffTime($createTime,$minutes){
        $startTime = Carbon::now();
        $endTime = $createTime->addMinutes($minutes);

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

    protected function certPasswordToken(Request $request){ // edit
        $code = $request->only('code');
        $codeCheck = DB::table('password_resets')->where('token','=',$code['code'])->first();

        return var_dump($codeCheck);

        if(!is_null($codeCheck)){
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

        $dataToken = CheckContoller::checkToken($request);
        $user = User::find($dataToken->id);

        $credentials = [
            'email'    => $user->email,
            'password' => $data['password'],
            'remember_token' => $request->header('X-lubycon-token')
        ];

        if (Auth::once($credentials)) {
            return response()->success([
                "validity" => true
            ]);
        }
        return response()->success([
            "validity" => false
        ]);
    }

    protected function activeUser($user){
        $user->is_active = 'active';
        $user->save();
    }
}
