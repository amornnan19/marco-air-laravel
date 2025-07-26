<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Service;
use Illuminate\Http\Request;
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

    public function orderDetail($orderId)
    {
        // For now, just return the mockup view
        // Later this will fetch actual order data from database
        return view('app.order-detail', compact('orderId'));
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

    public function products(Request $request)
    {
        $query = Product::active();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('brand', 'like', "%{$searchTerm}%")
                    ->orWhere('model', 'like', "%{$searchTerm}%")
                    ->orWhere('btu', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Brand filter
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        switch ($request->get('sort', 'featured')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'popular':
                // Assuming we track popularity somehow, for now use featured
                $query->orderBy('is_featured', 'desc')->orderBy('sort_order', 'asc');
                break;
            default: // featured
                $query->orderBy('is_featured', 'desc')->orderBy('sort_order', 'asc');
                break;
        }

        $products = $query->get();

        $promotions = Promotion::active()
            ->current()
            ->ordered()
            ->get();

        // Get available categories and brands for filter options
        $categories = Product::active()->distinct()->pluck('category')->filter();
        $brands = Product::active()->distinct()->pluck('brand')->filter();

        return view('app.products', compact('products', 'promotions', 'categories', 'brands'));
    }

    public function productDetail($productId)
    {
        $product = Product::active()
            ->findOrFail($productId);

        // Get related products from the same category
        $relatedProducts = Product::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->ordered()
            ->limit(4)
            ->get();

        return view('app.product-detail', compact('product', 'relatedProducts'));
    }

    public function showService($serviceSlug)
    {
        // Find service by slug
        $service = Service::active()
            ->where('slug', $serviceSlug)
            ->firstOrFail();
        
        return view('app.service-detail', compact('service'));
    }
}
