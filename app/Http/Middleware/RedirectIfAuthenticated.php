<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // If the user is authenticated and tries to visit /hackathon/ticket/case
        if (Auth::check()) {
            // Redirect authenticated users to the /hackathon/ticket/form page with an error message
            return redirect()->route('form.index')->withErrors(['error' => 'You are already authenticated and cannot access this page.']);
        }

        return $next($request);
    }
}
