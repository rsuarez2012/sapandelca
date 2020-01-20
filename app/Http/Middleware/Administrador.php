<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //if (! auth()->check())
          //  return redirect('login');

        //if (auth()->user()->role != 1) //no es admin, es diferente a 1
        //    return redirect('/login');
        //    
        if (! Auth::guard($guard)->check()) {
            return redirect('/login');
        }

        return $next($request);

    }
}
