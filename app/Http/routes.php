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

//Route::get('/', function () {
//    return 'this is index route';
//});

Route::POST('members/signin', 'Auth\AuthController@signin');
Route::GET('members/signout', 'Auth\AuthController@signout');
Route::POST('members/signup', 'Auth\AuthController@signup');

Route::GET('members/signdrop',function(){
	return 'signdrop page';
});
