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

use App\Http\Requests\Password\PasswordPostMailRequest;
use App\Http\Requests\Password\PasswordResetRequest;

class PasswordController extends Controller
{
    public function postEmail(PasswordPostMailRequest $request)
    {
        $response = MailSendController::passwordResetTokenSend($request);

        return response()->success();
    }

    public function postReset(PasswordResetRequest $request)
    {
        $data = $request->json()->all();

        if ($validator->fails()) {
            Abort::Error('0051');
        }

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
