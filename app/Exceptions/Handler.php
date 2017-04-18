<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
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
        parent::report($e);
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
        if (env('APP_DEBUG')) {
          return parent::render($request, $e);
        }

        $status = 200;
        $success = true;
        $response = null;

        if ($e instanceof HttpResponseException) {
          $success = false;
          $status = Response::HTTP_INTERNAL_SERVER_ERROR;
          $response = $e->getResponse();
        } elseif ($e instanceof MethodNotAllowedHttpException) {
          $success = false;
          $status = Response::HTTP_METHOD_NOT_ALLOWED;
          $e = new MethodNotAllowedHttpException([], 'HTTP_METHOD_NOT_ALLOWED', $e);
        } elseif ($e instanceof NotFoundHttpException) {
          $success = false;
          $status = Response::HTTP_NOT_FOUND;
          $e = new NotFoundHttpException('HTTP_NOT_FOUND', $e);
        } elseif ($e instanceof AuthorizationException) {
          $success = false;
          $status = Response::HTTP_FORBIDDEN;
          $e = new AuthorizationException('HTTP_FORBIDDEN', $status);
        } elseif ($e instanceof \Dotenv\Exception\ValidationException && $e->getResponse()) {
          $success = false;
          $status = Response::HTTP_BAD_REQUEST;
          $e = new \Dotenv\Exception\ValidationException('HTTP_BAD_REQUEST', $status, $e);
          $response = $e->getResponse();
        } elseif ($e) {
          $success = false;
          $status = Response::HTTP_INTERNAL_SERVER_ERROR;
          $e = new HttpException($status, 'HTTP_INTERNAL_SERVER_ERROR');
        }

        return response()->json([
          'success' => $success,
          'status' => $status,
          'message' => $e->getMessage()
        ], $status);
    }
}
