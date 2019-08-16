<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && auth()->user()->role->nombre==='admin' ) {
            return redirect('/admin');
        }else if(Auth::guard($guard)->check() && auth()->user()->role->nombre==='secre'){
             return redirect('/secre');
        }else if(Auth::guard($guard)->check() && auth()->user()->role->nombre==='tesor'){
            return redirect('/tesor');
       }

        return $next($request);
    }
}
