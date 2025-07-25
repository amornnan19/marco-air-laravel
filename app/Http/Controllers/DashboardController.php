<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
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
}
