<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
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
        $certToken = json_decode($this->certToken($request)->getContent());
        $data = $request->json()->all();
        $findUser = User::whereRaw("email = '".$this->user[0]->email."' and remember_token = '".$request->header('X-lubycon-token')."'")->get();

        return $findUser;

    }

    protected function certSignupToken(Request $request){
        $certToken = json_decode($this->certToken($request)->getContent());
        $data = $request->json()->all();
        $findUser = User::whereRaw("email = '".$this->user[0]->email."' and remember_token = '".$data['code']."'")->get();

        if($certToken->status->code == '0000' && !$findUser->isempty()){

            $this->activeUser($findUser);

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
        $user[0]->is_active = 'active';
        $user[0]->save();
    }
}
