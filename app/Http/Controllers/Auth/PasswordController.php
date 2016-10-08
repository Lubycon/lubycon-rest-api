<?php

namespace App\Http\Controllers\Auth;

use Validator;
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

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json([
                    'status' => (object)array(
                        'code' => '0000',
                        'msg' => "password token mail send success",
                        "devMsg" => ''
                    ),
                    'result' => null
                ]);
            case Password::INVALID_USER:
                return response()->json([
                    'status' => (object)array(
                        'code' => '0030',
                        'msg' => "INVALID_USER",
                        "devMsg" => 'unmatched email in database'
                    ),
                    'result' => null
                ]);
        }
    }

    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Your Password Reset Link';
    }

    public function postReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => (object)array(
                    'code' => '0030',
                    'msg' => "validate fail",
                    "devMsg" => $validator->errors()
                ),
                'result' => null
            ]);
        }

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return response()->json([
                    'status' => (object)array(
                        'code' => '0000',
                        'msg' => "password change success",
                        "devMsg" => ''
                    ),
                    'result' => null
                ]);
            default:
                return response()->json([
                    'status' => (object)array(
                        'code' => '0030',
                        'msg' => "wrong data",
                        "devMsg" => 'unmatched validate'
                    ),
                    'result' => null
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

        Auth::login($user);
    }
}
