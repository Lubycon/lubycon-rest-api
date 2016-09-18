<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('members', 'AuthController');


Route::post('members/signin',function(){

    $data = Request::json()->all();

    print_r($data);

	$credentials = [
        'email'    => $data['email'],
        'password' => $data['password']
    ];


    if (! Auth::attempt($credentials)) {
        return 'Incorrect username and password combination';
    }

    return 'signin user '.Auth::user()->name;
});

Route::get('members/signout',function(){
	Auth::logout();

    return 'sign out success';
});

Route::post('members/signup', 'Auth\AuthController@postRegister');

Route::get('members/signdrop',function(){
	return 'signdrop page';
});
