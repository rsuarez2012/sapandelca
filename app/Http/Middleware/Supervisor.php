<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Supervisor
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
        //dd($request);
        //if(auth()->user()->rol_id === '2')
        //    return response('Unauthorized.', 401);
        //
        $guard = auth()->user()->rol_id; 
        //dd($guard);
        //if (!Auth::guard($guard)->check()) {
        if($guard != '1' && $guard != '2'){
                return response('Acceso Denegado.', 403);
                //return view('errors.403');
        }

          return $next($request);

        //return redirect('/');
    }
}
