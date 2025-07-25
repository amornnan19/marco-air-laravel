<?php

namespace App\Http\Controllers;

use App\Models\Promotion;

class DashboardController extends Controller
{
    public function index()
    {
        $promotions = Promotion::active()
            ->current()
            ->ordered()
            ->get();

        return view('app.dashboard', compact('promotions'));
    }

    public function showPromotion(Promotion $promotion)
    {
        // Check if promotion is active and current
        if (! $promotion->is_active || ! $promotion->is_current) {
            abort(404);
        }

        return view('app.promotion-detail', compact('promotion'));
    }
}
