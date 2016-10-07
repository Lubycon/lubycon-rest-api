<?php

Route::post('/members/signin', 'Auth\AuthController@signin');
Route::put('/members/signout', 'Auth\AuthController@signout');
Route::post('/members/signup', 'Auth\AuthController@signup');
Route::put('/members/signdrop/{id}/{reasonCode}/{reason}', 'Auth\AuthController@signdrop');

Route::post('/members/isexist' , 'Auth\AuthController@checkMemberExist');
Route::get('/members/simple', 'Auth\AuthController@simpleRetrieve');
Route::get('/members/{user_code}', 'Auth\AuthController@getRetrieve');
Route::post('/members/{user_code}', 'Auth\AuthController@postRetrieve');

Route::post('/password/email', 'Auth\PasswordController@postEmail');
Route::post('/password/reset', 'Auth\PasswordController@postReset');

Route::post('/certs/token', 'CertificateController@certToken');
Route::post('/certs/signup/code', 'CertificateController@certSignupToken');
Route::post('/certs/pwd', 'CertificateController@certPassword');

