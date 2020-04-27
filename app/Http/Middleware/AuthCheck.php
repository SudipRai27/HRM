<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck
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
        if(auth()->guard('superadmin')->check() || auth()->guard('user')->check())
        {
            $authenticated = 'yes';            
        }
        else
        {
            $authenticated = 'no';
        }

        if($authenticated == 'no')
        {
            return redirect()->route('login-option-page');
        }

        return $next($request);
    }

 
}
