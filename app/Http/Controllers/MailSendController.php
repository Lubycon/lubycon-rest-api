<?php

namespace App\Http\Controllers;

use App\Events\PasswordMailSendEvent;
use App\Http\Controllers\Auth\CheckContoller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SignupAllow;

use Log;
use Mail;
// use Event;
use DB;
// use App\Events\MailSendEvent;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Jobs\MailSendJob;


class MailSendController extends Controller
{
    public function getSignupToken($email){
        return DB::table('signup_allows')->where('email','=',$email)->value('token');
    }

    // public function signupTokenSet($user){
    //
    //     $data = (object)array(
    //         "email" => $user->email,
    //         "type" => 'signup',
    //         "subject" => 'account success to Lubycon!',
    //         'token' => MailSendController::getSignupToken($user->email),
    //         "user" => $user
    //     );
    //     MailSendController::normalMailSend($data);
    // }

    public function againSignupTokenSet(Request $request){
        Log::info(111);
        $this->dispatchFrom('App\Jobs\SignupMailSendJob', $request);
        // $this->dispatch(new SignupMailSendJob($data));
        // $tokenData = CheckContoller::checkToken($request);
        // $user = User::findOrFail($tokenData->id);
        // CheckContoller::insertSignupToken($user->id);
        // $data = (object)array(
        //     "email" => $user->email,
        //     "type" => 'signup',
        //     "subject" => 'resend account mail from Lubycon!',
        //     'token' => MailSendController::getSignupToken($user->email),
        //     "user" => $user
        // );
        // $this->normalMailSend($data);
    }

    protected function normalMailSend($data){
    }


    // public function passwordResetTokenSend(Request $request){
    //     $data = $request->json()->all();
    //     $sendMail = Event::fire(new PasswordMailSendEvent([
    //         'email'    =>  $data['email'],
    //         'subject'  => 'Your Password Reset Link',
    //         'token' => str_random(40),
    //     ]));
    //
    //     return $sendMail;
    // }
}
