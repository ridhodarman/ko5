<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CekStatus
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
        if (Auth::check())
        {
            if (Auth::user()->role == 99) {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
