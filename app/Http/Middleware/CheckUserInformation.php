<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserInformation
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

        // Check if name, email, and designation are filled
        if ($user->name == '' && $user->email == '' && $user->designation == '') {
            // Allow the request to proceed if all fields are filled
            return $next($request);
        }

        // Redirect to the info page if any field is empty
        return redirect()->route('form.index');
    }
}
