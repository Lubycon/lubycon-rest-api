<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('success', function ($value) use ($factory) {
            return response()->json([
                'errors'  => false,
                'data' => $value,
            ]);
        });

        $factory->macro('error', function ($value) use ($factory){
            return response()->json([
                'errors'  => true,
                'message' => $value,
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
