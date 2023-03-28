<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MultiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role == "super-admin") {
            //  return $next($request);
                return redirect(route('dashboard.multi-auth.index'));
            }
            else{
                // return redirect(route('dashboard.home'));
                return $next($request);
            }
        }
         
    }
}
