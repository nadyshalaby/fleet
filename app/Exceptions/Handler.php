<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->renderable(function (Throwable $e, $request) {


            if ($request->is('api/*')) {

                $type = get_class($e);

                switch ($type) {
                    case AuthenticationException::class:
                        $status_code = 401;
                        break;
                    case AccessDeniedHttpException::class:
                        $status_code = 403;
                        break;
                    case NotFoundHttpException::class:
                        $status_code = 404;
                        break;
                    default:
                        $status_code = 500;
                        break;
                }

                return response()->json(['success' => false, 'msg' => $e->getMessage() ?: last(explode('\\', $type)), 'data' => []], $status_code);
                // return response()->json(['success' => false, 'msg' => $e->getMessage() ?: last(explode('\\', $type)), 'data' => $e->getTrace()], $status_code);
            }

            $this->report($e);
        });
    }
}
