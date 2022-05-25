<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PacienteController;

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
Route::apiResource('pacientes',PacienteController::class);
