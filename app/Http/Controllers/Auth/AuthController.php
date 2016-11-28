<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use DB;
use Auth;
use Event;

use App\Models\User;
use App\Models\Credential;
use App\Models\Validation;
use App\Models\Job;
use App\Models\Country;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Abort;

use Log;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function signin(Request $request)
    {
        $data = $request->json()->all();
        $credentials = Credential::signin($data);

        if(!Auth::once($credentials)){
            Abort::Error('0040','Login Failed, check email,password');
        }

        if (Auth::user()->status == 'inactive'){
            return response()->success([
                'token' => Auth::user()->remember_token,
                'condition' => 'inactive'
            ]);
        }

        if(Auth::user()->status == 'active'){
            CheckContoller::insertRememberToken(Auth::user()->id);
        }

        return response()->success([
            'token' => Auth::user()->remember_token,
            'condition' => 'active',
            'grade' => Auth::user()->grade,
        ]);
    }


    protected function signout()
    {
        // need somthing other logic
    }

    protected function signup(Request $request)
    {
        $data = $request->json()->all();
        $credentialSignup = Credential::signup($data);
        $credentialSignin = Credential::signin($data);
        $ResultOfValidation = Validation::auth($credentialSignup);

        if(User::create($credentialSignup)){
            if(Auth::once($credentialSignin)){
                $id = Auth::user()->getAuthIdentifier();
                CheckContoller::insertSignupToken($id);
                $rememberToken = CheckContoller::insertRememberToken($id);
            }
            MailSendController::signupTokenSet(Auth::user());
            return response()->success([
                "token" => $rememberToken
            ]);
        }
    }

    protected function signdrop(Request $request)
    {
        $tokenData = CheckContoller::checkToken($request);

        $user = User::findOrFail($tokenData->id);
        $userExist = CheckContoller::checkUserExistById($tokenData->id);

        if($userExist){
            $user->delete();
            return response()->success();
        }else{
            Abort::Error('0040');
        };
    }

    // protected function signrestore($id){
    //     $user = User::onlyTrashed()->find($id);
    //     $userExist = CheckContoller::checkUserExistByIdOnlyTrashed($id);
    //
    //     if($userExist){
    //         $user->restore();
    //         return response()->success();
    //     }else{
    //         Abort::Error('0030');
    //     };
    // }

    protected function simpleRetrieve(Request $request){
        $tokenData = CheckContoller::checkToken($request);

        $findUser = User::findOrFail($tokenData->id);
        $userExist = CheckContoller::checkUserExistById($tokenData->id);
        $jobExists = $findUser->job;
        $counTryExists = $findUser->country;

        if($userExist){
            $result = (object)array(
                "id" => $findUser->id,
                "email" => $findUser->email,
                "name" => $findUser->name,
                "profile" => $findUser->profile_img,
                "job" => is_null($jobExists) ? null : $findUser->job->name,
                "country" => is_null($counTryExists) ? null : $findUser->country->name,
                "city" => $findUser->city,
                "position" => $findUser->company,
                "description" => $findUser->description
            );
            return response()->success($result);
        }else{
            Abort::Error('0040');
        }
    }

    protected function getRetrieve($id)
    {
        $findUser = User::findOrFail($id);
        $userExist = CheckContoller::checkUserExistById($id);

        $jobExists = $findUser->job;
        $counTryExists = $findUser->country;

        if($userExist){
            return response()->success([
                'userData' => (object)array(
                    "id" => $findUser->id,
                    "email" => $findUser->email,
                    "name" => $findUser->name,
                    "profile" => $findUser->profile_img,
                    "job" => is_null($jobExists) ? null : $findUser->job->name,
                    "country" => is_null($counTryExists) ? null : $findUser->country->name,
                    "city" => $findUser->city,
                    "mobile" => $findUser->mobile,
                    "fax" => $findUser->fax,
                    "website" => $findUser->web,
                    "position" => $findUser->company,
                    "description" => $findUser->description
                ),
                "language" => $findUser->language,
                "history" => $findUser->career,
                "publicOption" => (object)array(
                    "email" => $findUser->email_public,
                    "mobile" => $findUser->mobile_public,
                    "fax" => $findUser->fax_public,
                    "website" => $findUser->web_public
                )
            ]);
        }else{
            Abort::Error('0040');
        }
    }
    public function postRetrieve(Request $request,$id)
    {
        $data = $request->json()->all();
        $tokenData = CheckContoller::checkToken($request);

        $findUser = User::find($tokenData->id);
        $userExist = CheckContoller::checkUserExistById($tokenData->id);

        if($userExist && $id == $findUser->id){
                $this->resetDataGroup($findUser);

                //$findUser->profile_img = $data['userData']['profile'];
                $findUser->job_id = Job::where('name','=',$data['userData']['job'])->value('id');
                $findUser->country_id = Country::where('name','=',$data['userData']['country'])->value('id');
                $findUser->city = $data['userData']['city'];
                $findUser->mobile = $data['userData']['mobile'];
                $findUser->fax = $data['userData']['fax'];
                $findUser->web = $data['userData']['website'];
                $findUser->company = $data['userData']['position'];
                $findUser->description = $data['userData']['description'];
                $findUser->mobile_public = $data['publicOption']['mobile'];
                $findUser->fax_public = $data['publicOption']['fax'];
                $findUser->web_public = $data['publicOption']['website'];
                DB::table('languages')->insert($this->insertDataGroup($data['language'],$id));
                DB::table('careers')->insert($this->setCareerGroup($data['history'],$id));
                if($findUser->save()){
                    return response()->success($data);
                }
        }else{
            Abort::Error('0040');
        }
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
            return response()->success([
                "exist" => true
            ]);
        }else{
            return response()->success([
                "exist" => false
            ]);
        }
    }
}
