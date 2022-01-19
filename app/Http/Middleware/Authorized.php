<?php

namespace App\Http\Middleware;

use App\Policies\Gates;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Authorized
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
        $name = $request->route()->getName();
        
        if(! Gates::resolve($name) ) {
            abort(404);
        } 

        return $next($request);
    }
}
