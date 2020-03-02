<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPersonas extends FormRequest
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
       'nombresP.required' => 'Nombre requerido',
       'identificacionP.unique' => 'Ya existe una persona con esa identifiacion'
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
            'nombresP' => 'required',
            'identificacionP' => 'required|unique:personas,identificacion',
            

        ];
    }
}
