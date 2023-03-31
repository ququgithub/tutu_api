<?php

namespace App\Exceptions;

use App\Library\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;
use ErrorException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof MethodNotAllowedHttpException) {
            return Response::error([], 101, $e->getMessage() . $e->getFile() . $e->getLine(), 404);
        }
        if ($e instanceof HttpException) {
            return Response::error([], 101, $e->getMessage() . "||" . $e->getFile() . $e->getLine(), 403);
        }
        if ($e instanceof ErrorException) {
            return Response::error([], 101, $e->getMessage() . $e->getFile() . $e->getLine(), 500);
        }
        if ($e instanceof QueryException) {
            return Response::error([], 101, $e->getMessage() . $e->getFile() . $e->getLine(), 500);
        }
        if ($e instanceof ValidationException) {
            return Response::error([], 101, $e->validator->getMessageBag()->first(), 422);
        }
        return Response::error([], 101, $e->getMessage() . $e->getFile() . $e->getLine());
    }
}
