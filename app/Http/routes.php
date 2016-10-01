<?php

Route::post('members/signin', 'Auth\AuthController@signin');
Route::put('members/signout', 'Auth\AuthController@signout');
Route::post('members/signup', 'Auth\AuthController@signup');
Route::put('/members/signdrop/{id}/{reasonCode}/{reason}', 'Auth\AuthController@signdrop');