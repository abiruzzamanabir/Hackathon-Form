<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    // Redirect to Google's OAuth page
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle the Google callback
    public function handleGoogleCallback()
    {
        // Retrieve the user from Google
        $googleUser = Socialite::driver('google')->user();

        // Check if the user already exists, or create a new one
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        } else {
            // Optionally update the user's name and avatar if needed
            $user->update([
                'name' => $googleUser->getName(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        }


        // Log the user in
        Auth::login($user, true);

        // Redirect to the form.index route or another desired page
        return redirect()->route('form.index');
    }
    public function handleLogout()
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token to prevent session fixation attacks
        session()->invalidate();
        session()->regenerateToken();

        // Redirect to a specific route (for example, the homepage or login page)
        return redirect()->route('signin-signup.index'); // Adjust the route as needed
    }
}
