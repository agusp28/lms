<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PengajarMiddleware
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
        if (Auth::check() && Auth::user()->level == "pengajar") {
            return $next($request);   
        }else{
            return redirect()->route('home');
        }
    }
}
