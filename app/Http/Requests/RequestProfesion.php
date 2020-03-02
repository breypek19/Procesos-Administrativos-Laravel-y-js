<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProfesion extends FormRequest
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
       'nom.required' => 'Profesion requerida',
       'nom.unique' => 'Ya existe una Profesion con ese Nombre'
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
            'nom' => 'required|unique:profesions,nombre|min:4'
        ];
    }
}
