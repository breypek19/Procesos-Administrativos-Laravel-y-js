<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUser extends FormRequest
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
       'nom_usuario.required' => 'Usuario requerido',
       'nom_usuario.unique' => 'Ya existe un usuario con ese Nombre',
       'email_us.unique' => 'Ya existe un usuario con ese Email'
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
                'nom_usuario' => 'required|unique:users,nom_usuario|min:7',
                'passw' => 'required|unique:users,password|min:7',
                'email_us' => 'required|email:rf|unique:users,email',
                'rol_us' => 'required'
                
            ];
        }
}
