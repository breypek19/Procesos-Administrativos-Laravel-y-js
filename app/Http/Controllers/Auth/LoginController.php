<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */ 

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//laravel  autentica con el email, si se quiere cambiar esto se crea este metodo username() y se pone el campo 
//que se quiera
    public function username()
{
    return 'nom_usuario';
}

//laravel por defecto retorno a la uri /home luego de la autenticacion
//si se quiere cambiar esto y meter alguna logica se crea un metodo redirecto()
    protected function redirectTo()
{


   $rolUserAutenticado= \Auth::user()->role->nombre;
   
   if(  $rolUserAutenticado === 'admin')
    {
        return '/admin';
    } else if($rolUserAutenticado === 'secre') {
        return '/secre';
    }else if($rolUserAutenticado === 'tesor'){
         return '/tesor';
    }

    
}
}
