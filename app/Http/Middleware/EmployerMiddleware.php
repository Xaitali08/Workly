<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (auth()->check() && auth()->user()->role === 'employer') {
            return $next($request);
        }

        abort(403, 'Sizga bu sahifaga kirishga ruxsat yo‘q.');
    }
}
