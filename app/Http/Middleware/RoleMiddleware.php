<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    function __construct(){

    }

    public function handle($request, Closure $next)
    {
        if(!\Auth::user()->hasRole(1)){
            return redirect()->route('404');
        }
        return $next($request);
    }
}
