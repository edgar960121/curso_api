<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\DataBase\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    //Traduce el mensaje de data error a español
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'msg' => __('Los datos proporcionados no son válidos.'),
            'error' => $exception->errors(),
        ], $exception->status);
    }
    //Mensaje de error cuando no encuentre el dato buscado
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json([
                "res" => false, 
                "error" => "Error modelo no encontrado"], 400);
        }
        if($exception instanceof RouteNotFoundException){
            return response()->json([
                "res" => false, 
                "error" => "No tiene Permisos para acceder a esta ruta"], 401);
        }
        return parent::render($request, $exception);
    }
}
