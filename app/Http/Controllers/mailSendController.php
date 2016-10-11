<?php

namespace App\Http\Controllers;

use App\Events\PasswordMailSendEvent;
use App\Http\Controllers\Auth\CheckContoller;
use Illuminate\Http\Request;

use App\User;
use Mail;
use Event;
use App\Events\MailSendEvent;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class mailSendController extends Controller
{
    public static function signupTokenSend(Request $request){

        $tokenData = CheckContoller::checkToken($request);

        $user = User::findOrFail($tokenData->id);
        $to = $user->id;

        Event::fire(new MailSendEvent([
            'email'    =>  $to,
            'type'     => 'signup',
            'subject'  => 'account success to Lubycon!',
            'user'     => $user
        ]));
    }

    public static function passwordResetTokenSend(Request $request){

        $data = $request->json()->all();

        Event::fire(new PasswordMailSendEvent([
            'email'    =>  $data['email'],
            'subject'  => 'Your Password Reset Link',
        ]));

        return 'sueccess';
    }
}
