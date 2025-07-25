<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_dealers' => User::where('role', 'dealer')->count(),
            'total_admins' => User::where('role', 'admin')->orWhere('is_admin', true)->count(),
            'total_promotions' => Promotion::count(),
            'active_promotions' => Promotion::active()->count(),
            'current_promotions' => Promotion::active()->current()->count(),
        ];

        $recent_users = User::latest()->take(5)->get();
        $recent_promotions = Promotion::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_promotions'));
    }
}
