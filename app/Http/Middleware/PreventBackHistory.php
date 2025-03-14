<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the response from the next middleware or controller
        $response = $next($request);

        // Set headers to prevent caching
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        if (Auth::check() && $request->is('login')) {
            return redirect('/home')->with('info', 'You are already logged in.');
        }

        // If the user is not authenticated and tries to access a protected page, redirect them to the login page
        if (!Auth::check() && !$request->is('login')) {
            return redirect('/login')->with('error', 'You need to log in to access this page.');
        }

        return $response;
    }
}
