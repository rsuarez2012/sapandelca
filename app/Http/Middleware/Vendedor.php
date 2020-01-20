<?php

namespace App\Http\Middleware;
//use Illuminate\Support\Facades\Auth;

use Closure;

class Vendedor
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
        
        $guard = auth()->user()->rol_id; 
        
        if($guard != '1' && $guard != '3'){
                return response('Acceso Denegado.', 403);
        }
        return $next($request);
    }
}
