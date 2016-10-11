<?php

Route::post('/members/signin', 'Auth\AuthController@signin');
Route::put('/members/signout', 'Auth\AuthController@signout');
Route::post('/members/signup', 'Auth\AuthController@signup');
Route::put('/members/signdrop', 'Auth\AuthController@signdrop');
Route::put('/members/signrestore/{id}', 'Auth\AuthController@signrestore');

Route::post('/members/isexist' , 'Auth\AuthController@checkMemberExist');
Route::get('/members/simple', 'Auth\AuthController@simpleRetrieve');
Route::get('/members/detail', 'Auth\AuthController@getRetrieve');
Route::post('/members/detail', 'Auth\AuthController@postRetrieve');

Route::post('/members/pwd/mail', 'Auth\PasswordController@postEmail');
Route::post('/members/pwd/reset', 'Auth\PasswordController@postReset');

Route::post('/certs/token', 'CertificateController@certToken');
Route::get('/certs/signup/time', 'CertificateController@certTokenTimeCheck');
Route::post('/certs/signup/code', 'CertificateController@certSignupToken');
Route::post('/certs/pwd', 'CertificateController@certPassword');

Route::put('mail/signup','mailSendController@againSignupTokenSet');
Route::put('mail/pwd','mailSendController@passwordResetTokenSend');