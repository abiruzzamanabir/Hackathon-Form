<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Authenticate
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
        // Check if user is authenticated
        if (Auth::check()) {
            // Check if the user is blocked
            $user = Auth::user();
            if ($user->isBlocked) {
                // Logout the user and redirect them with a message
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Your account is currently banned. Please contact support for assistance.']);
            }
        }

        return $next($request);
    }
}
