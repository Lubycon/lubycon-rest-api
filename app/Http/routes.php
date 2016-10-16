<?php

//about members event
Route::group(['prefix' => '/members/'], function () {
    //authenicates
    Route::post('signin', 'Auth\AuthController@signin');
    Route::put('signout', 'Auth\AuthController@signout');
    Route::post('signup', 'Auth\AuthController@signup');
    Route::put('signdrop', 'Auth\AuthController@signdrop');
    Route::put('signrestore/{id}', 'Auth\AuthController@signrestore');

    //member data check and get
    Route::post('isexist' , 'Auth\AuthController@checkMemberExist');
    Route::get('simple', 'Auth\AuthController@simpleRetrieve');
    Route::get('detail/{id}', 'Auth\AuthController@getRetrieve');
    Route::post('detail/{id}', 'Auth\AuthController@postRetrieve');

    //about password
    Route::group(['prefix' => 'pwd/'], function () {
        Route::post('mail', 'Auth\PasswordController@postEmail');
        Route::post('reset', 'Auth\PasswordController@postReset');
    });
});

//certificate receive data
Route::group(['prefix' => '/certs/'], function () {
    Route::post('token', 'CertificateController@certToken');
    Route::post('pwd', 'CertificateController@certPassword');

    Route::group(['prefix' => 'signup/'], function () {
        Route::get('time', 'CertificateController@certTokenTimeCheck');
        Route::post('code', 'CertificateController@certSignupToken');
    });
});

//just send mail
Route::group(['prefix' => '/mail/'], function () {
    Route::put('signup','mailSendController@againSignupTokenSet');
    Route::put('pwd','mailSendController@passwordResetTokenSend');
});

//provide databases data
Route::group(['prefix' => '/data/'], function () {
    Route::get('{id}','dataResponseController@dataSimpleResponse');
});
