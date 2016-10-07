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
            return response()->json([
                'status' => (object)array(
                    'code' => '0000',
                    'msg' => "token available",
                    "devMsg" => ''
                ),
                'result' => (object)array(
                    "validity" => true
                )
            ]);
        }else{
            return response()->json([
                'status' => (object)array(
                    'code' => '0000',
                    'msg' => "token unavailable",
                    "devMsg" => ''
                ),
                'result' => (object)array(
                    "validity" => false
                )
            ]);
        }
    }

    protected function certSignupToken(Request $request){
        $certToken = json_decode($this->certToken($request)->getContent());
        $data = $request->json()->all();
        $findUser = User::whereRaw("email = '".$this->user[0]->email."' and remember_token = '".$data['code']."'")->get();

        if($certToken->status->code == '0000' && !$findUser->isempty()){

            $this->activeUser($findUser);

            return response()->json([
                'status' => (object)array(
                    'code' => '0000',
                    'msg' => "attempt success",
                    "devMsg" => ''
                ),
                'result' => (object)array(
                    "validity" => true
                )
            ]);
        }
        return response()->json([
            'status' => (object)array(
                'code' => '0030',
                'msg' => "attempt fail",
                "devMsg" => ''
            ),
            'result' => (object)array(
                "validity" => false
            )
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
            return response()->json([
                'status' => (object)array(
                    'code' => '0000',
                    'msg' => "attempt success",
                    "devMsg" => ''
                ),
                'result' => (object)array(
                    "validity" => true
                )
            ]);
        }
        return response()->json([
            'status' => (object)array(
                'code' => '0030',
                'msg' => "attempt fail",
                "devMsg" => ''
            ),
            'result' => (object)array(
                "validity" => false
            )
        ]);
    }

    protected function activeUser($user){
        $user[0]->is_active = 'active';
        $user[0]->save();
    }
}
