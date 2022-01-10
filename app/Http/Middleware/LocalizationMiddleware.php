<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LocalizationMiddleware
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
        if(Auth::user()) {
            if( !in_array(Auth::user()->lang,['ar','en']) ) {
                abort(404);
            }
    
            App::setLocale(Auth::user()->lang);
        }

        return $next($request);
    }
}
