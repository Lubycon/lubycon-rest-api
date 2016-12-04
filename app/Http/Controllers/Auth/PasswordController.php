<?php

namespace App\Http\Controllers\Auth;

use Abort;
use DB;
use Validator;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;


class PasswordController extends Controller
{
    public function postEmail(Request $request)
    {
        $response = MailSendController::passwordResetTokenSend($request);

        return response()->success();
    }

    public function postReset(Request $request)
    {
        $data = $request->json()->all();

        $credentials = array(
            "email" => DB::table('password_resets')->where('token','=',$data['code'])->value('email'),
            "password" => $data['newPassword'],
            "password_confirmation" => $data['newPassword'],
            "token" => $data['code']
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return response()->success();
            default:
                Abort::Error('0040');
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }
}
