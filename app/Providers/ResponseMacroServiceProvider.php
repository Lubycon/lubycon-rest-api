<?php

namespace App\Providers;

use App\Http\Controllers\ErrorController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;


class ResponseMacroServiceProvider extends ServiceProvider
{

    public static $errors = [
        "0010" => "Login Failure",
        "0011" => "Login is required",
        "0012" => "No permission",
        "0013" => "Verification code not match",
        "0014" => "Not verified signup user",
        "0020" => "Key generation failed",
        "0030" => "Data type does not match",
        "0040" => "Exceeded capacity",
        "0041" => "The file is not supported",
        "0042" => "Upload Failed(communication error with contents server)",
        "0050" => "Sent mail Failure",
        "0060" => "Sign up Failure",
        "0061" => "Redundant data",
        "0062" => "Data does not exist",
        "9999" => "Unknown Error"
    ];


    public function boot(ResponseFactory $factory)
    {
        $factory->macro('success', function ($data=null) use ($factory) {
            return response()->json([
                'status' => (object)array(
                    'code' => '0000',
                    'msg' => "success",
                    "devMsg" => ''
                ),
                'result' => isset($data) ? $data : null
            ]);
        });

        $factory->macro('error', function ($data) use ($factory) {
            $errors = [
                "0010" => "Login Failure",
                "0011" => "Login is required",
                "0012" => "No permission",
                "0013" => "Verification code not match",
                "0014" => "Not verified signup user",
                "0020" => "Key generation failed",
                "0030" => "Data type does not match",
                "0040" => "Exceeded capacity",
                "0041" => "The file is not supported",
                "0042" => "Upload Failed(communication error with contents server)",
                "0050" => "Sent mail Failure",
                "0060" => "Sign up Failure",
                "0061" => "Redundant data",
                "0062" => "Data does not exist",
                "9999" => "Unknown Error"
            ];

            return response()->json([
                'status' => (object)array(
                    'code' => $data->code,
                    'msg' => $errors[$data->code],
                    "devMsg" => isset($data->devMsg) ? $data->devMsg : ''
                ),
                'result' => null
            ]);


        });

    }

    public function register()
    {
        //
    }
}
