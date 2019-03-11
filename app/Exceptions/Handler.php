<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
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
        $class = get_class($exception);

        switch($class) {
            case 'Illuminate\Auth\AuthenticationException':
                $guard = array_get($exception->guards(), 0);
                switch ($guard) {
                    case 'faculty':
                        $login = 'login.faculty';
                        break;
                    default:
                        $login = 'login';
                        break;
                }

                return redirect()->route($login);
        }

        return parent::render($request, $exception);
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {

//        if ($request->expectsJson()) {
//            return response()->json(['error' => 'Unauthenticated.'], 401);
//        }

        $guard=array_get($exception->guards(),0);


        switch ($guard){
            case 'faculty':
                $redirect=route('login.faculty');
                break;

            default:
                $redirect=route('login');
                break;
        }


        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest($exception->redirectTo() ?? route($redirect));


      //  return redirect()->guest(route($redirect));

    }


}
