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
            return response()->json([
                'status' => (object)array(
                    'code' => $data['code'],
                    'msg' => config('error.'.$data['code'])->msg,
                    "devMsg" => isset($data['devMsg']) ? $data['devMsg'] : ''
                ),
                'result' => null
            ],config('error.'.$data['code'])->httpCode);
        });
    }
    public function register()
    {
        //
    }
}
