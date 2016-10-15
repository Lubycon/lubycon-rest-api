<?php

namespace App\Http\Controllers;

use App\Events\PasswordMailSendEvent;
use App\Http\Controllers\Auth\CheckContoller;
use Illuminate\Http\Request;

use App\User;
use App\signup_allow;
use Mail;
use Event;
use DB;
use App\Events\MailSendEvent;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class mailSendController extends Controller
{
    public static function getSignupToken($email){
        return DB::table('signup_allows')->where('email','=',$email)->value('token');
    }

    public static function signupTokenSet($user){

        $data = (object)array(
            "email" => $user->email,
            "type" => 'signup',
            "subject" => 'account success to Lubycon!',
            'token' => mailSendController::getSignupToken($user->email),
            "user" => $user
        );
        mailSendController::normalMailSend($data);
    }

    public static function againSignupTokenSet(Request $request){

        $tokenData = CheckContoller::checkToken($request);

        $user = User::findOrFail($tokenData->id);

        $data = (object)array(
            "email" => $user->email,
            "type" => 'signup',
            "subject" => 'resend account mail from Lubycon!',
            'token' => mailSendController::getSignupToken($user->email),
            "user" => $user
        );
        checkContoller::insertSignupToken($user->id);
        mailSendController::normalMailSend($data);
    }

    protected static function normalMailSend($data){
        Event::fire(new MailSendEvent($data));
    }


    public static function passwordResetTokenSend(Request $request){

        $data = $request->json()->all();

        Event::fire(new PasswordMailSendEvent([
            'email'    =>  $data['email'],
            'subject'  => 'Your Password Reset Link',
            'token' => mailSendController::getSignupToken($data['email']),
        ]));

        return 'sueccess';
    }
}
