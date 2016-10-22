<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use DB;
use Auth;
use Event;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\mailSendController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            //'password' => 'required|confirmed|min:6',
        ];
        return Validator::make($data, $rules);
    }
    protected function signin(Request $request)
    {
        $data = $request->json()->all();
        $credentials = [
            'email'    => $data['email'],
            'password' => $data['password']
        ];

        if ( !Auth::once($credentials)) {
            $status = (object)array(
                'code' => '0010'
            );
            return response()->error($status);
        }

        if(Auth::user()->is_active == 'active'){
            $id = Auth::user()->getAuthIdentifier();
            CheckContoller::insertRememberToken($id);
        }

        if (Auth::user()->is_active == 'inactive'){
            $result = (object)array(
                'token' => Auth::user()->remember_token,
                'condition' => 'inactive'
            );
            return response()->success($result);
        }


        $result = (object)array(
            'token' => Auth::user()->remember_token,
            'condition' => 'active',
         );

        return response()->success($result);
    }


    protected function signout()
    {
        // need somthing other logic
    }

    protected function signup(Request $request)
    {
        $data = $request->json()->all();
        $createData = [
            'name' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'sns_code' => 0,
            'country' => $this->countryDataEncode($data['country']),
            'is_active' => 'inactive',
            'is_accept_terms' => '111',
            //'is_accept_terms' => $data['newletter'].'11',
        ];

        $validator = $this->validator($createData);
        if ($validator->fails()) {
            $status = (object)array(
                'code' => '0030',
                "devMsg" => $validator->errors()
            );
            return response()->error($status);
        };

        if(User::create($createData)){
            $credentials = [
                'email'    => $data['email'],
                'password' => $data['password']
            ];

            if(Auth::once($credentials)){
                $id = Auth::user()->getAuthIdentifier();
                CheckContoller::insertSignupToken($id);
                $rememberToken = CheckContoller::insertRememberToken($id);
            }

            mailSendController::signupTokenSet(Auth::user());

            return response()->success([
                "token" => $rememberToken
            ]);
        }
    }

    protected function signdrop(Request $request)
    {
        $tokenData = CheckContoller::checkToken($request);

        $user = User::find($tokenData->id);
        $userExist = CheckContoller::checkUserExistById($tokenData->id);

        if($userExist){
            $user->delete();
            return response()->success();
        }else{
            $status = (object)array(
                'code' => '0030'
            );
            return response()->error($status);
        };
    }

    protected function signrestore($id){
        $user = User::onlyTrashed()->find($id);
        $userExist = CheckContoller::checkUserExistByIdOnlyTrashed($id);

        if($userExist){
            $user->restore();
            return response()->success();
        }else{
            $status = (object)array(
                'code' => '0030'
            );
            return response()->error($status);
        };
    }

    protected function simpleRetrieve(Request $request){
        $tokenData = CheckContoller::checkToken($request);

        $findUser = User::find($tokenData->id);
        $userExist = CheckContoller::checkUserExistById($tokenData->id);

        if($userExist){
            $result = (object)array(
                "id" => $findUser->id,
                "email" => $findUser->email,
                "name" => $findUser->name,
                "profile" => $findUser->profile,
                "job" => is_null($job) ? null : $findUser->jobs->name,
                "country" => $findUser->countries->name,
                "city" => $findUser->city,
                "position" => $findUser->position,
                "description" => $findUser->description
            );
            return response()->success($result);
        }else{
            $status = (object)array(
                'code' => '0030'
            );
            return response()->error($status);
        }
    }

    protected function getRetrieve($id)
    {
        $findUser = User::find($id);
        $userExist = CheckContoller::checkUserExistById($id);

        $job = $findUser->jobs;
        $country = $findUser->countries;

        if($userExist){
            return response()->success([
                'userData' => (object)array(
                    "id" => $findUser->id,
                    "email" => $findUser->email,
                    "name" => $findUser->name,
                    "profile" => $findUser->profile_img,
                    "job" => is_null($job) ? null : $findUser->jobs->name,
                    "country" => $findUser->countries->name,
                    "city" => $findUser->city,
                    "mobile" => $findUser->mobile,
                    "fax" => $findUser->fax,
                    "website" => $findUser->web,
                    "position" => $findUser->company,
                    "description" => $findUser->description
                ),
                "language" => $findUser->languages,
                "history" => $findUser->careers,
                "publicOption" => (object)array(
                    "email" => $findUser->email_public,
                    "mobile" => $findUser->mobile_public,
                    "fax" => $findUser->fax_public,
                    "website" => $findUser->web_public
                )
            ]);
        }else{
            $status = (object)array(
                'code' => '0030',
                "devMsg" => "user number " . $id . " dose not exist"
            );
            return response()->error($status);
        }
    }
    protected function postRetrieve(Request $request,$id)
    {
        $data = $request->json()->all();
        $tokenData = CheckContoller::checkToken($request);

        $findUser = User::find($tokenData->id);
        $userExist = CheckContoller::checkUserExistById($tokenData->id);

        if($userExist && $id == $findUser->id){
                $this->resetDataGroup($findUser);

                //$findUser->profile_img = $data['userData']['profile'];
                $findUser->job = $this->jobDataEncode($data['userData']['job']);
                $findUser->country = $this->countryDataEncode($data['userData']['country']);
                $findUser->city = $data['userData']['city'];
                $findUser->mobile = $data['userData']['mobile'];
                $findUser->fax = $data['userData']['fax'];
                $findUser->web = $data['userData']['website'];
                $findUser->company = $data['userData']['position'];
                $findUser->description = $data['userData']['description'];
                $findUser->mobile_public = $data['publicOption']['mobile'];
                $findUser->fax_public = $data['publicOption']['fax'];
                $findUser->web_public = $data['publicOption']['website'];
                $findUser->save();
                DB::table('languages')->insert($this->insertDataGroup($data['language'],$id));
                DB::table('careers')->insert($this->setCareerGroup($data['history'],$id));
            return response()->success($data);
        }else{
            $status = (object)array(
                'code' => '0030',
                "devMsg" => "dose not match user id"
            );
            return response()->error($status);
        }
    }
    protected function jobDataEncode($string){
        return DB::table('jobs')->where('name','=',$string)->value('job_id');
    }
    protected function countryDataEncode($string){
        return DB::table('countries')->where('name','=',$string)->value('country_id');
    }
    protected function insertDataGroup($array,$id){
        foreach($array as $key => $value){
            $array[$key]['user_id'] = (int)$id;
        }
        return $array;
    }
    protected function setCareerGroup($array,$id){
        $newGroup = array();

        foreach($array as $key => $value){
            $newGroup[$key]['user_id'] = (int)$id;
            $newGroup[$key]['content'] = $array[$key]['content'];
            $newGroup[$key]['date'] = Carbon::parse($array[$key]['date'])->toDateTimeString();
            $newGroup[$key]['category'] = $array[$key]['category'];
        }
        return $newGroup;
    }
    protected function resetDataGroup($user){
        DB::table('languages')->where('user_id','=',$user->id)->delete();
        DB::table('careers')->where('user_id','=',$user->id)->delete();
    }

    protected function checkMemberExist(Request $request)
    {
        $data = $request->json()->all();
        $check = CheckContoller::checkUserExistByEmail($data);

        if($check){
            $result = (object)array(
                "exist" => true
            );
            return response()->success($result);
        }else{
            $result = (object)array(
                "exist" => false
            );
            return response()->success($result);
        }
    }
}

