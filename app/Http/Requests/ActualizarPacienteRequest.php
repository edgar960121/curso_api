<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarPacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //El this->route agregamos un nuevo parametro donde capturamos la ruta y del id agrega el mismo dni esto es en caso de los datos que son unique
        //El id coincida con el del json que queremos actualizar
        return [
            "nombres" => "required",
            "apellidos" => "required",
            "edad" => "required",
            "sexo" => "required",
            "dni" => "required|unique:pacientes,dni,".$this->route('paciente')->id,
            "tipo_sangre" => "required",
            "telefono" => "required",
            "correo" => "required",
            "direccion" => "required"
        ];
    }
}
