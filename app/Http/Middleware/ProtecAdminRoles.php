<?php

namespace App\Http\Middleware;

use Closure;

class ProtecAdminRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //si el usuario autenticado tiene rol admin dejo que pase, sino redirecciono a otra ruta.
        //Este middelware lo pongo en la vista admin, para que no deje ver a otros usuarios que no tengan 
        //este rol
        if ( auth()->user()->role->nombre==='admin') {
            return $next($request);
        }

        return redirect('/' . auth()->user()->role->nombre);
    }
}
