<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRubroE extends FormRequest
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



    public function messages()
    {
        return [
//campos que vienen de la solicitud
       'nombreRubro.required' => 'Dato requerido',
       'nombreRubro.unique' => 'Ya existe un Rubro con ese Nombre'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreRubro' => 'required|unique:rubroegresos,nombre'
        ];
    }
}
