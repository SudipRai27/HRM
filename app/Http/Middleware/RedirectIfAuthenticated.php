<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

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
        
        if(auth()->guard('superadmin')->check())
        {
            Session::flash('error-msg', 'You are already logged in as superadmin');
            return redirect()->route('superadmin-home');
            
        }
        if(auth()->guard('user')->check())
        {
            Session::flash('error-msg', 'You are already logged in as user');
            return redirect()->route('user-home');
        }

        return $next($request);

    }
}
