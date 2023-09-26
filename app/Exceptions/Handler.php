<?php

namespace App\Exceptions;

use Throwable;
use App\Support\Facades\ApiResponder;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Overwrite render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (!$request->expectsJson()) {
            return parent::render($request, $exception);
        }

        if ($exception instanceof AuthenticationException) {
            return ApiResponder::unauthorized();
        } else if ($exception instanceof AuthorizationException) {
            return ApiResponder::forbiddenAction();
        } else if ($exception instanceof ModelNotFoundException) {
            return ApiResponder::notFound();
        } else if ($exception instanceof ValidationException) {
            return ApiResponder::inputError($exception->errors());
        } else if ($exception instanceof BadRequestException) {
            return ApiResponder::error($exception->getMessage());
        } else {
            return ApiResponder::serverError($exception->getMessage());
        }
    }
}
