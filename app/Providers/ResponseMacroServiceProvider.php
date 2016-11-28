<?php

namespace App\Providers;

use App\Http\Controllers\ErrorController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;


class ResponseMacroServiceProvider extends ServiceProvider
{
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
            $code = $data['code'];
            $config = config('error.'.$data['code']);
            $msg = $config->msg;
            $httpCode = isset($data['httpCode']) ? $data['httpCode'] : $config->httpCode;
            $devMsg = isset($data['devMsg']) ? $data['devMsg'] : '';
            return response()->json([
                'status' => (object)array(
                    'code' => $code,
                    'msg' => $msg,
                    "devMsg" => $devMsg
                ),
                'result' => null
            ],$httpCode);
        });
    }
    public function register()
    {
        //
    }
}
