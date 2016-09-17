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


Route::get('auth/signin',function(){
	return 'login page';
});

Route::get('auth/signout',function(){
	return 'logout page';
});

Route::get('auth/signup',function(){
	return 'signup page';
});
Route::get('auth/signdrop',function(){
	return 'signdrop page';
});