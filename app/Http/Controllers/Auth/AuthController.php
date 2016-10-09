<?php

namespace App\Http\Controllers\Auth;

use Mail;
use DB;
use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
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

        $this->makeToken(Auth::user());

        if (Auth::user()->is_active == 'inactive'){
            $result = (object)array(
                'token' => Auth::user()->remember_token,
                'condition' => 'inactive',
            );
            return response()->success($result);
        }


        $result = (object)array(
            'token' => Auth::user()->remember_token,
            'condition' => 'active',
         );

        return response()->success($result);
    }

    protected function makeToken(){
        $userId = Auth::user()->getAuthIdentifier();
        $device = 'w';
        $randomStr = Str::random(30);
        $token = $device.$randomStr.$userId; //need change first src from header device kind
        Auth::user()->remember_token = $token;
        Auth::user()->save();
    }

    protected function signout()
    {
        // need somthing other logic
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function signup(Request $request)
    {
        $data = $request->json()->all();
        $createData = [
            'name' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'sns_code' => 0,
            //'sns_code' => $data['snsCode'],
            'country_id' => 'test',
            //'country_id' => $data['country'],
            'is_active' => 'inactive',
            'is_accept_terms' => '111',
            //'is_accept_terms' => $data['newletter'].'11',
            'is_opened' => 0000
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
                $this->makeToken();
            }

            $to = $data['email'];
            $subject = 'account success to Lubycon!';
            $data = [
                'user'  => Auth::user()
            ];

            Mail::send('emails.signup', $data, function($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            });

            $result = (object)array(
                "email" => Auth::user()->email
            );
            return response()->success($result);
        }
    }

    protected function signdrop(Request $request,$reasonCode,$reason)
    {
        $tokenData = $this->checkToken($request);

        $user = User::find($tokenData->id);
        $userExist = $this->checkUserExistById($tokenData->id);

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
        $userExist = $this->checkUserExistByIdOnlyTrashed($id);

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
        $tokenData = $this->checkToken($request);

        $findUser = User::find($tokenData->id);
        $userExist = $this->checkUserExistById($tokenData->id);

        if($userExist){
            $result = (object)array(
                "id" => $findUser->id,
                "email" => $findUser->email,
                "name" => $findUser->name,
                "profile" => $findUser->profile,
                "job" => $findUser->job,
                "country" => $findUser->country,
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

    protected function getRetrieve(Request $request)
    {
        $tokenData = $this->checkToken($request);

        $findUser = User::find($tokenData->id);
        $userExist = $this->checkUserExistById($tokenData->id);
        if($userExist){
            $result = (object)array(
                'userData' => (object)array(
                    "id" => $findUser->id,
                    "email" => $findUser->email,
                    "name" => $findUser->name,
                    "profile" => $findUser->profile,
                    "job" => $findUser->job,
                    "country" => $findUser->country,
                    "city" => $findUser->city,
                    "mobile" => $findUser->mobile,
                    "fax" => $findUser->fax,
                    "website" => $findUser->website,
                    "position" => $findUser->position,
                    "description" => $findUser->description
                ),
                "language" => (object)array(
                    "name" => null,
                    "level" => null
                ),
                "history" => (object)array(
                    "year" => null,
                    "month" => null,
                    "category" => null,
                    "content" => null
                ),
                "publicOption" => (object)array(
                    "mobile" => null,
                    "fax" => null,
                    "website" => null
                )
            );
            return response()->success($result);
        }else{
            $status = (object)array(
                'code' => '0030',
                "devMsg" => "user number " . $tokenData->id . " dose not exist"
            );
            return response()->error($status);
        }
    }
    protected function postRetrieve(Request $request)
    {
        $data = $request->json()->all();
        $tokenData = $this->checkToken($request);

        $findUser = User::find($tokenData->id);
        $userExist = $this->checkUserExistById($tokenData->id);
        if($userExist){
            $result = (object)array(
                'userData' => (object)array(
                    $findUser->id = $data->id,
                    $findUser->email = $data->email,
                    $findUser->name = $data->name,
                    $findUser->profile = $data->profile,
                    $findUser->job = $data->job,
                    $findUser->country = $data->country,
                    $findUser->city = $data->city,
                    $findUser->mobile = $data->mobile,
                    $findUser->fax = $data->fax,
                    $findUser->website = $data->website,
                    $findUser->position = $data->position,
                    $findUser->description = $data->description
                ),
                "language" => (object)array(
                    "name" => null,
                    "level" => null
                ),
                "history" => (object)array(
                    "year" => null,
                    "month" => null,
                    "category" => null,
                    "content" => null
                ),
                "publicOption" => (object)array(
                    "mobile" => null,
                    "fax" => null,
                    "website" => null
                )
            );
            return response()->success($result);
        }else{
            $status = (object)array(
                'code' => '0030',
                "devMsg" => "user number " . $tokenData->id . " dose not exist"
            );
            return response()->error($status);
        }
    }
    protected function checkMemberExist(Request $request)
    {
        $data = $request->json()->all();
        $user = User::whereRaw("email = '".$data['email']."' and sns_code = ".$data['snsCode'])->get();

        if(!$user->isempty()){
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

    public function checkToken($request){
        $token = $request->header('X-lubycon-token');
        $tokenData = (object)array(
            "device" => substr($token, 0, 1),
            "token" => substr($token, 1, 30),
            "id" => substr($token, 31),
        );
        return $tokenData;
    }

    public function checkUserExistById($id){
        $user=User::find($id);
        if (!is_null($user)) {
            return true;
        }
        return false;
    }

    public function checkUserExistByIdOnlyTrashed($id){
        $user=User::onlyTrashed()->find($id);
        if (!is_null($user)) {
            return true;
        }
        return false;
    }
}

