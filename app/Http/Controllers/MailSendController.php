<?php

namespace App\Http\Controllers;

use App\Events\PasswordMailSendEvent;
use App\Http\Controllers\Auth\CheckContoller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SignupAllow;

use Log;
use Mail;
use Event;
use DB;
use App\Events\MailSendEvent;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\Certs\CertsPasswordMailSendRequest;

class MailSendController extends Controller
{
    public static function getSignupToken($email){
        return DB::table('signup_allows')->where('email','=',$email)->value('token');
    }

    public static function signupTokenSet($user){

        $data = (object)array(
            "email" => $user->email,
            "type" => 'signup',
            "subject" => 'account success to Lubycon!',
            'token' => MailSendController::getSignupToken($user->email),
            "user" => $user
        );
        MailSendController::normalMailSend($data);
    }

    public static function againSignupTokenSet(Request $request){

        $tokenData = CheckContoller::checkToken($request);
        $user = User::findOrFail($tokenData->id);
        CheckContoller::insertSignupToken($user->id);
        $data = (object)array(
            "email" => $user->email,
            "type" => 'signup',
            "subject" => 'resend account mail from Lubycon!',
            'token' => MailSendController::getSignupToken($user->email),
            "user" => $user
        );
        MailSendController::normalMailSend($data);
    }

    protected static function normalMailSend($data){
        Event::fire(new MailSendEvent($data));
    }


    public static function passwordResetTokenSend(CertsPasswordMailSendRequest $request){
        $data = $request->json()->all();
        $sendMail = Event::fire(new PasswordMailSendEvent([
            'email'    =>  $data['email'],
            'subject'  => 'Your Password Reset Link',
            'token' => str_random(40),
        ]));

        return $sendMail;
    }
}
