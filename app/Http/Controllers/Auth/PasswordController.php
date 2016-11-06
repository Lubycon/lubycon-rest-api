<?php

namespace App\Http\Controllers\Auth;

use DB;
use Validator;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = MailSendController::passwordResetTokenSend($request);

        return response()->success();
    }

    public function postReset(Request $request)
    {
        $data = $request->json()->all();
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'newPassword' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->error([
                'code' => '0030',
                "devMsg" => $validator->errors()
            ]);
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
                return response()->error([
                    'code' => '0030'
                ]);
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
