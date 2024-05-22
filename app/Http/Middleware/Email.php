<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Email
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the session cookie from the request
        $sessionCookieName = config('session.cookie'); // Get the session cookie name from the config
        $sessionCookieValue = $request->cookie($sessionCookieName); // Get the session cookie value

        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json([
                "notifications" => -1,
                "success" => false,
                "message" => "Unauthorized access"
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Proceed with the next middleware or the request
        return $next($request);
    }
}
