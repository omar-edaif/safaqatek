<?php

/*
*   Developer : takidddine soulaimane
*   Email     : takiddine.job@gmail.com
*   whatsapp  :  +212658829307
*/

namespace App\Helpers;

use App\Bots\TestsBot;

use App\Helpers\HttpCodes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Facade\Ignition\Exceptions\ViewException;
use Hamcrest\Type\IsNumeric;
use Stripe\Exception\AuthenticationException as StripeAuthentication;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\CardException;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\RateLimitException;
use Tymon\JWTAuth\Exceptions\JWTException;

class Exceptions
{
    private $request;
    private $exception;
    private $error;

    public function __construct($request, $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
        $this->check_if_known();
        $this->handle();
    }

    public function report()
    {
        return response()->json($this->error, $this->error['code']);
    }

    private function known()
    {
        return [
            'Symfony\Component\HttpKernel\Exception\NotFoundHttpException',
            'Illuminate\Database\Eloquent\ModelNotFoundException',
            'Illuminate\Database\QueryException',

            'Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException',
            'Illuminate\Auth\AuthenticationException',

            'Illuminate\Routing\Route',
            'ErrorException',
            'Illuminate\Validation\ValidationException',
            'Symfony\Component\ErrorHandler\Error\FatalError',

            // stripe errors
            'Stripe\Error\InvalidRequest',
            'Stripe\Error\Card',
            'Stripe\Error\Authentication',
            'Facade\Ignition\Exceptions\ViewException',
            'Stripe\Exception\InvalidRequestException',
            'Stripe\Exception\CardException',
        ];
    }

    private function check_if_known()
    {
        $known = $this->known();
        $new = get_class($this->exception);
        $unknown = !in_array($new, $known);
    }

    private function execution_time()
    {
        $executionEndTime = microtime(true);
        $seconds = $executionEndTime - LARAVEL_START;
        $seconds = number_format($seconds, 3) . ' seconds';

        return $seconds;
    }



    private function handle()
    {


        $error = [
            'state' => false
        ];

        if ($this->exception instanceof InvalidRequestException) {
            $error['code']    = '306';
            $error['error'] = 'stripe payment error : ' . $this->exception->getMessage();
        } elseif ($this->exception instanceof CardException) {
            $error['code']    = '306';
            $error['error'] = 'stripe payment error : ' . $this->exception->getMessage();
        } elseif ($this->exception instanceof StripeAuthentication) {
            $error['code']    = '306';
            $error['error'] = ' Api keys error : ' . $this->exception->getMessage();
        } elseif ($this->exception instanceof InvalidRequestException) {
            $error['code']    = '306';
            $error['error'] = 'stripe payment error : ' . $this->exception->getMessage();
        } elseif ($this->exception instanceof CardException) {
            $error['code']    = '306';
            $error['error'] = 'stripe payment error : ' . $this->exception->getMessage();
        } elseif ($this->exception instanceof RateLimitException) {
            $error['code']    = '306';
            $error['error'] = $this->exception->getMessage();
        } elseif ($this->exception instanceof ApiConnectionException) {
            $error['code']    = '306';
            $error['error'] = $this->exception->getMessage();
        } elseif ($this->exception instanceof ApiErrorException) {
            $error['code']    = '306';
            $error['error'] = $this->exception->getMessage();
        } elseif ($this->exception instanceof ModelNotFoundException) {
            $model = explode('\\', $this->exception->getModel());
            $modelName = end($model);
            $trans = 'api.notFound.' . $modelName;
            $message = trans($trans) ?? '';
            $error['code']    = HttpCodes::MODEL_NOT_FOUND;
            $error['error'] = $message;
        } elseif ($this->exception instanceof ValidationException) {
            $errorMessage = $this->exception->validator->errors()->first();
            $error['code']          =   HttpCodes::VALIDATION_ERROR;
            $error['error']       =   $errorMessage;
        } elseif ($this->exception instanceof AuthenticationException) {
            $error['code']    = HttpCodes::UNAUTHENTICATED;
            $error['error'] = trans('api.failed.unauthenticated');
        } elseif ($this->exception instanceof NotFoundHttpException || $this->exception instanceof RouteNotFoundException) {
            $error['code']    = HttpCodes::NOT_FOUND;
            $error['error'] = trans('api.failed.route_not_found');
        } elseif ($this->exception instanceof MethodNotAllowedHttpException) {
            $error['code']    = HttpCodes::NOT_ALLOWED;
            $error['error'] = $this->request->method() . " method not allowed ";
        } elseif ($this->exception instanceof QueryException) {
            $error['code']    = HttpCodes::QUERY_ERROR;
            $error['error'] = trans('api.database.error');
            $error['sql_error'] = $this->exception->getMessage();
        } elseif ($this->exception instanceof ViewException) {
            $error['code']    = HttpCodes::VIEW_ERROR;
            $error['error'] = trans('api.something_went_wrong_blade');
            $error['view_error'] =   $this->exception->getMessage();
        } elseif ($this->exception instanceof JWTException) {
            $error['code']    = HttpCodes::TOKEN_NOT_FOUND;
            $error['error'] = $this->exception->getMessage();
        } else {



            $error['code']    = HttpCodes::FATAL_ERROR;
            $error['error'] = "server error : " . $this->exception->getMessage();
            $error['file']    = $this->exception->getFile();
            $error['line']    = $this->exception->getLine();
            $error['is_auth'] = Auth::check();
            $error['user_id'] = optional(auth()->user())->id;
            $error['mobile']  = optional(auth()->user())->mobile;
            $error['device']  = optional(auth()->user())->device_type;
            $error['catched_at']  = now()->todatetimestring();
            $error['trace'] =  $this->exception->getTrace();
        }

        if (@$error['code'] == HttpCodes::FATAL_ERROR) {
            unset($error['trace']);
            $ms = json_encode($error);
        }





        $error['execution'] = $this->execution_time();

        $this->error = $error;
    }
}
