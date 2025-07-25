<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Skip if user is not authenticated
        if (! $user) {
            return $next($request);
        }

        // Skip if already on update-profile, terms page or logout route
        if ($request->is('update-profile') || $request->is('terms') || $request->is('logout')) {
            return $next($request);
        }

        // Check if phone number is missing
        if (empty($user->phone)) {
            return redirect()->route('profile.edit');
        }

        // Check if terms not accepted
        if (! $user->terms_accepted) {
            return redirect()->route('terms.show');
        }

        return $next($request);
    }
}
