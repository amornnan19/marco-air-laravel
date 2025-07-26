<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! Auth::check()) {
            // If accessing admin routes, redirect to admin login
            if ($request->is('control-panel/*')) {
                return redirect()->route('admin.login');
            }

            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user has the required role or admin privileges
        if ($role === 'admin') {
            // For admin routes, check both role and is_admin flag
            if (! $user->isAdmin()) {
                return redirect()->route('admin.login')
                    ->withErrors(['email' => 'คุณไม่มีสิทธิ์เข้าถึงหน้า Admin']);
            }
        } else {
            // For other roles, check exact role match
            if (! $user->hasRole($role)) {
                // Redirect to appropriate dashboard based on user type
                if ($user->isAdmin()) {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->hasRole('dealer')) {
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
