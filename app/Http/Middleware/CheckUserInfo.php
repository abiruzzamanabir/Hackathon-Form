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
        $user = Auth::user();

        // Check if user information is complete
        $isComplete = $user->name && $user->designation && $user->organization && $user->phone && $user->address;

        // If the user's information is incomplete and they're not on the /info page, redirect them
        if (!$isComplete && $request->path() !== 'info') {
            return redirect()->route('info.index');
        }

        return $next($request);
    }
}
