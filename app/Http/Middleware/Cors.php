<?php
//
//namespace App\Http\Middleware;
//
//use Closure;
//
//class Cors
//{
//    public function handle($request, Closure $next)
//    {
//        $headers = [
//            'Access-Control-Allow-Origin' => '*',
//            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
//            'Access-Control-Allow-Headers'=> 'Content-Length, Content-Type,',
//            'Access-Control-Expose-Headers' => 'Content-Length,Content-Type,',
//            'Access-Control-Allow-Credentials' => true
//        ];
//
//        if($request->getMethod() == "OPTIONS") {
//            return response()->withHeaders($headers);
//        }
//
//        $response = $next($request);
//        foreach ($headers as $key => $value) {
//            $response->header($key, $value);
//        }
//
//        return $response;
//    }
//}
//
