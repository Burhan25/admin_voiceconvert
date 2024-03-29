<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsOperator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role == 'operator') {
            return $next($request);
        }
        if (auth()->user()->role == 'admin') {
            return redirect('login')->with('error', "You don't have admin access.");
        }

        Auth::logout();

        return redirect('login')->with('error', "You don't have admin access.");
    }
}
