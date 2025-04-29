<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
        if (Auth::check() && Auth::user()->user_type === $type) {
            return $next($request); // If the user's type matches, the request proceeds
        }
    
        // If not, return a 403 error
        return abort(403, 'Unauthorized action.');
    }
}
