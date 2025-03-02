<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserInfo
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
        $user = auth()->user();

        // Check if name, email, and designation are null
        if (is_null($user->name) || is_null($user->email) || is_null($user->designation)) {
            // Redirect to /info if any of the fields are null
            return redirect()->route('info.index');
        }

        // Allow the request to proceed to the /form page if the info is complete
        return $next($request);
    }
}
