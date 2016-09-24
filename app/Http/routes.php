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
    return 'this is index route';
});

Route::post('members/signin', 'Auth\AuthController@signin');
Route::get('members/signout', 'Auth\AuthController@signout');
Route::post('members/signup', 'Auth\AuthController@signup');

Route::get('members/signdrop',function(){
	return 'signdrop page';
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});