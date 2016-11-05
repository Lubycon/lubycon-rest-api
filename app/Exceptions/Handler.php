<?php

namespace App\Exceptions;

use Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
     public function render($request, Exception $e)
     {
         log::error($e);

         if(env('APP_DEBUG')){
             return parent::render($request , $e); //for develop
         }else{
             if ($e instanceof ModelNotFoundException) {
                 return response()->error([
                     "code" => "0062"
                 ]);
             }
             return $this->response($request, $e); //for provide
         }
     }

     public function response($request, Exception $e)
     {
         $exception = array(
             "httpStatusCode" => $this->getExceptionHTTPStatusCode($e),
             "msg" => $this->getJsonMessage($e),
         );

         $status = [
             'code' => '9999',
             'devMsg' => $exception
         ];
         return response()->error($status);
     }

     protected function getJsonMessage($e){
         return $e->getMessage();
     }

     protected function getExceptionHTTPStatusCode($e){
         return method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
     }

 }
