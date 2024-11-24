<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CookieTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the request has the 'bingewatchSecureID' cookie
        if ($request->hasCookie('bingewatchSecureId')) {
            // Retrieve the token from the cookie
            $token = $request->cookie('bingewatchSecureId');

            // Set the Authorization header with the Bearer token
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }
}
