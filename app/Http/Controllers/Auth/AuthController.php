<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

//use Illuminate\Http\Response;


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
        $this->middleware('cors');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    protected function signin()
    {
        $data = Request::json()->all();
        $credentials = [
            'email'    => $data['email'],
            'password' => $data['password']
        ];

        if (! Auth::attempt($credentials,true)) {
            return 'Incorrect username and password combination';
        }
        return response()->json([
            'X-lubycon-token' => Auth::user()->remember_token
        ]);
    }

    protected function signout()
    {
        Auth::logout();
        return response()->json([
            'state' => 'signout'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function signup()
    {
        $data = Request::json()->all();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'sns_code' => $data['snsCode'],
            'country_id' => $data['country'],
            'is_active' => 'inactive',
            'is_accept_terms' => $data['newletter'].'11',
            'is_opened' => 0000
        ]);
    }
}