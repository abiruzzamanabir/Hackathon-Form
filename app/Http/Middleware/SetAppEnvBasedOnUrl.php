<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetAppEnvBasedOnUrl
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
        // Dynamically set APP_ENV based on the URL
        if (strpos($request->getHost(), 'localhost') !== false) {
            // Set to 'local' if URL contains 'localhost'
            env('APP_ENV', 'local');
        } else {
            // Set to 'production' otherwise
            env('APP_ENV', 'production');
        }

        return $next($request);
    }
}
