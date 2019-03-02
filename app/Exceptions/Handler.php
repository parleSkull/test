<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Embed\Exceptions\InvalidUrlException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

/**
 * Class Handler.
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof InvalidUrlException) {
                return res(400, $exception->getMessage());
            }

            if ($exception instanceof TokenMismatchException) {
                return res(401, $exception->getMessage());
            }

            // 404 not found
            if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
                return res(404, $exception->getMessage());
            }

            // not allowed method
            if ($exception instanceof MethodNotAllowedHttpException) {
                return res(405, $exception->getMessage());
            }

            // validation errors
            if ($exception instanceof ValidationException) {
                return res(422, $exception->errors());
            }

            // service unavailable
            if ($exception instanceof MaintenanceModeException) {
                return res(503, $exception->getMessage());
            }

            if ($exception instanceof UnauthorizedException) {
                return res(403, $exception->getMessage());
            }

            if ($exception instanceof HttpException) {
                return res($exception->getStatusCode(), $exception->getMessage());
            }
        }else{
            if ($exception instanceof TokenMismatchException) {
                return redirect()->guest(route('frontend.auth.login'));
            }

            if ($exception instanceof UnauthorizedException) {
                return redirect()
                    ->route(home_route())
                    ->withFlashDanger(__('auth.general_error'));
            }
        }

        return parent::render($request, $exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException  $exception
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? res(401, null)
            : redirect()->guest(route('frontend.auth.login'));
    }
}
