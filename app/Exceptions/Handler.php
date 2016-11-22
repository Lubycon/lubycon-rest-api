<?php

namespace App\Exceptions;

use Log;
use Exception;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

use Carbon\Carbon;

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
                     "httpCode" => 404,
                     "code" => "0062"
                 ]);
             }
             if($e instanceof NotFoundHttpException){
                 return response()->error([
                     "httpCode" => 404,
                     "code" => "0070"
                 ]);
             }
             if($e instanceof ConflictHttpException){
                 return response()->error([
                     "httpCode" => 409,
                     "code" => "0071"
                 ]);
             }
             if($e instanceof AccessDeniedHttpException){
                 return response()->error([
                     "httpCode" => 403,
                     "code" => "0012"
                 ]);
             }
             if($e instanceof BadRequestHttpException){
                 return response()->error([
                     "httpCode" => 400,
                     "code" => "0072"
                 ]);
             }
             if($e instanceof FatalErrorException){
                 return response()->error([
                     "httpCode" => 500,
                     "code" => "0073",
                     "devMsg" => Carbon::now()->toDateTimeString()." -> error occur time. plz send to daniel this time."
                 ]);
             }
             if($e instanceof MethodNotAllowedHttpException){
                 return response()->error([
                     "httpCode" => 405,
                     "code" => "0074"
                 ]);
             }
             if($e instanceof ServiceUnavailableHttpException){
                 return response()->error([
                     "httpCode" => 503,
                     "code" => "0075"
                 ]);
             }
             if($e instanceof TooManyRequestsHttpException){
                 return response()->error([
                     "httpCode" => 429,
                     "code" => "0076"
                 ]);
             }
             if($e instanceof UnauthorizedHttpException){
                 return response()->error([
                     "httpCode" => 401,
                     "code" => "0077"
                 ]);
             }

             return $this->response($request, $e); //for provide
         }
     }

     public function response($request, Exception $e)
     {
         $exception = (object)array(
             "httpStatusCode" => $this->getExceptionHTTPStatusCode($e),
             "msg" => $this->getJsonMessage($e),
         );

         $status = [
             'httpCode' => $exception->httpStatusCode,
             'code' => '9999',
             'devMsg' => $exception->msg
         ];
         return var_dump($e);
         return response()->error($status);
     }

     protected function getJsonMessage($e){
         return method_exists($e, 'getMessage') ? $e->getMessage() : 500;;
     }

     protected function getExceptionHTTPStatusCode($e){
         return method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
     }

 }
