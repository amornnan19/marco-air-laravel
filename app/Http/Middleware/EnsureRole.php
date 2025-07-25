<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            // If accessing admin routes, redirect to admin login
            if ($request->is('admin/*')) {
                return redirect()->route('admin.login');
            }
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Check if user has the required role
        if (!$user->hasRole($role)) {
            // If trying to access admin but user is not admin
            if ($role === 'admin' && !$user->isAdmin()) {
                return redirect()->route('admin.login')
                    ->withErrors(['email' => 'คุณไม่มีสิทธิ์เข้าถึงหน้า Admin']);
            }
            
            // For other roles, redirect to appropriate dashboard
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('dealer')) {
                return redirect()->route('dashboard'); // No dealer dashboard yet
            } else {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
