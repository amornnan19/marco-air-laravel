<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Promotion;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Check user role and redirect to appropriate dashboard
        $user = Auth::user();

        if ($user->role === 'dealer') {
            return $this->dealerDashboard();
        }

        // Default customer dashboard
        $promotions = Promotion::active()
            ->current()
            ->ordered()
            ->get();

        $articles = Article::published()
            ->ordered()
            ->limit(6)
            ->get();

        return view('app.dashboard', compact('promotions', 'articles'));
    }

    public function dealerDashboard()
    {
        return view('app.dealer-dashboard');
    }

    public function showPromotion(Promotion $promotion)
    {
        // Check if promotion is active and current
        if (! $promotion->is_active || ! $promotion->is_current) {
            abort(404);
        }

        return view('app.promotion-detail', compact('promotion'));
    }

    public function showArticle(Article $article)
    {
        // Check if article is published
        if (! $article->isPublished()) {
            abort(404);
        }

        // Increment views count
        $article->incrementViews();

        return view('app.article-detail', compact('article'));
    }

    public function articles()
    {
        $articles = Article::published()
            ->ordered()
            ->paginate(10);

        return view('app.articles', compact('articles'));
    }

    public function promotions()
    {
        $promotions = Promotion::active()
            ->current()
            ->ordered()
            ->paginate(10);

        return view('app.promotions', compact('promotions'));
    }
}
