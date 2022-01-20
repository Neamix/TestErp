<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkPassword
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
        if( password_verify($request->password,Auth::user()->password) ) {
            return $next($request);
        } 

        return abort(412,__('validation.wronge_password'));
    }
}
