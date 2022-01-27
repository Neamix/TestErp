<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class checkAuthority
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

        if($request->route('user')) {
            $user = $request->route('user');

            if(gettype($user) == 'string') $user = User::onlyTrashed()->where('id',$user)->first();
            
            if($user->id != Auth::id()) {
                if( ! $user->allowedToActionOn()) {
                    return abort('417','unAuthorized');
                }
            }
        }

        return $next($request);
    }
}
