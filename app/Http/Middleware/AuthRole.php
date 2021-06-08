<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
			return redirect()->route('dashboard');
		}

		if (Auth::user()->role == 'admin') {
			return $next($request);
		} else {
			return redirect()->route('login')->with('message', 'maaf anda bukan admin');
		}
    }
}
