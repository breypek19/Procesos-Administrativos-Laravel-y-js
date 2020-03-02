<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestDetalle extends FormRequest
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
       'detall.required' => 'Dato requerido',
       'detall.unique' => 'Ya existe un Detalle con ese Nombre'
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
            'detall' => 'required|unique:detalleingresos,nombre|min:4'
        ];
    }
}
