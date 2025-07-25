<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LineLoginController extends Controller
{
    /**
     * Redirect the user to the LINE authentication page.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('line')->redirect();
    }

    /**
     * Obtain the user information from LINE.
     */
    public function handleProviderCallback()
    {
        try {
            $lineUser = Socialite::driver('line')->user();

            // Find existing user or create new one
            $user = User::where('line_id', $lineUser->getId())->first();

            if (! $user) {
                $user = User::create([
                    'name' => $lineUser->getName() ?? 'LINE User',
                    'email' => $lineUser->getEmail() ?? $lineUser->getId().'@line.local',
                    'line_id' => $lineUser->getId(),
                    'line_avatar' => $lineUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)), // Random password since we use LINE auth
                ]);
            } else {
                // Update user info if needed
                $user->update([
                    'name' => $lineUser->getName() ?? $user->name,
                    'line_avatar' => $lineUser->getAvatar(),
                ]);
            }

            // Log the user in
            Auth::login($user);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Failed to login with LINE. Please try again.');
        }
    }
}
