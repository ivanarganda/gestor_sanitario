<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Api_login extends Controller
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
        if (Auth::check() === false) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized access or expired session"
            ], Response::HTTP_UNAUTHORIZED);
        }

        dd( $this->userExists( Auth::user()->id ));

        return $next($request);
    }
}
