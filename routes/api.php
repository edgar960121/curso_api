<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PacienteController;
use App\Http\Controllers\AutenticarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*::get('pacientes',[PacienteController::class, 'index']);
//Ruta para guardar informacion de los pacientes
Route::post('pacientes',[PacienteController::class, 'store']);
//Ruta para buscar a un paciente
Route::get('pacientes/{paciente}',[PacienteController::class, 'show']);
//Ruta para actualizar PUT ó PATCH
Route::put('pacientes/{paciente}',[PacienteController::class, 'update']);
//Ruta para eliminar
Route::delete('pacientes/{paciente}',[PacienteController::class, 'destroy']);*/

Route::post('registro', [AutenticarController::class, 'registro']);
Route::post('acceso', [AutenticarController::class, 'acceso']);

//se prodrá acceder unicamente a los que tienen token
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('logout', [AutenticarController::class, 'cerrarSesion']);
    Route::apiResource('pacientes',PacienteController::class);
});