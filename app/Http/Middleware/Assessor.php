<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Assessor
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
        if (Auth::check() && (Auth::user()->role_id == 6 || Auth::user()->role_id == 7 || Auth::user()->role_id == 2)){
            return $next($request);
        }

        return redirect('account');
    }
}
