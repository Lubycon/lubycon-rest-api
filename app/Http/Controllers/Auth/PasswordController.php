<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\mailSendController;
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

        $response = mailSendController::passwordResetTokenSend($request);

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->success();
            case Password::INVALID_USER:
                $status = (object)array(
                    'code' => '0030'
                );
                return response()->error($status);
        }
    }

    public function postReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            $status = (object)array(
                'code' => '0030',
                "devMsg" => $validator->errors()
            );
            return response()->error($status);
        }

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return response()->success();
            default:
                $status = (object)array(
                    'code' => '0030'
                );
                return response()->error($status);
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

        Auth::login($user);
    }
}
