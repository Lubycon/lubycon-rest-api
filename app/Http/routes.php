<?php

Route::post('members/signin', 'Auth\AuthController@signin');
Route::put('members/signout', 'Auth\AuthController@signout');
Route::post('members/signup', 'Auth\AuthController@signup');

Route::get('members/signdrop',function(){
    return 'signdrop page';
});