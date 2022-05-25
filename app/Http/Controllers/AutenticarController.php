<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegistroRequest;
use App\Http\Requests\AccesoRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AutenticarController extends Controller
{
    public function registro(RegistroRequest $request){
        $user = new User();
        //Registrar el nombre, email, pass del usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'res' => true,
            'msg' => 'Usuario Registrado Correctamente'
        ], 200);
    }

    public function acceso(AccesoRequest $request){
        $user = User::where('email','=', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'msg' => ['Las credenciales son incorrectas.'],
            ]);
        }
        //Creando token asignando a un usuario
        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'res'=>true,
            'token' => $token
        ], 200);
    }

    public function cerrarSesion(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'res'=>true,
            'msg' => 'Token Eliminado Correctamente'
        ], 200);
    }
}
