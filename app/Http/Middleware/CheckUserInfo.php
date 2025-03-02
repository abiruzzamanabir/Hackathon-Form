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

        // Check if the user has completed their profile
        $isComplete = $user->name && $user->designation && $user->organization && $user->phone && $user->address;

        // If the user's profile is complete, prevent access to /ticket/info
        if ($isComplete && $request->is('ticket/info')) {
            return redirect()->route('form.index'); // Redirect them to another page (e.g., /form)
        }

        return $next($request);
    }
}
