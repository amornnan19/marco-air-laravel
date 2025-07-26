<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Login route (required by Laravel auth system)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/', function () {
    // If user is authenticated, redirect to appropriate page
    if (Auth::check()) {
        $user = Auth::user();

        // Check if profile is incomplete
        if (empty($user->phone)) {
            return redirect()->route('profile.edit');
        }

        // Check if terms not accepted
        if (! $user->terms_accepted) {
            return redirect()->route('terms.show');
        }

        // Profile complete and terms accepted, go to dashboard
        return redirect()->route('dashboard');
    }

    // Not authenticated, show login page
    return view('auth.login');
});

// LINE Login Routes
Route::get('/auth/line', 'App\Http\Controllers\Auth\LineLoginController@redirectToProvider')->name('line.login');
Route::get('/auth/line/callback', 'App\Http\Controllers\Auth\LineLoginController@handleProviderCallback')->name('line.callback');

// Profile update routes
Route::get('/update-profile', 'App\Http\Controllers\ProfileController@edit')->middleware('auth')->name('profile.edit');
Route::put('/update-profile', 'App\Http\Controllers\ProfileController@update')->middleware('auth')->name('profile.update');

// Terms and conditions routes
Route::get('/terms', 'App\Http\Controllers\TermsController@show')->middleware('auth')->name('terms.show');
Route::post('/terms', 'App\Http\Controllers\TermsController@accept')->middleware('auth')->name('terms.accept');

// Policy pages (accessible without authentication)
Route::get('/terms-conditions', function () {
    return view('policy.terms-conditions');
})->name('terms.conditions');

Route::get('/privacy-policy', function () {
    return view('policy.privacy-policy');
})->name('privacy.policy');

Route::get('/cookie-policy', function () {
    return view('policy.cookie-policy');
})->name('cookie.policy');

// Dashboard (protected route)
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])
    ->name('dashboard');

// Dealer Dashboard (protected route)
Route::get('/dealer-dashboard', 'App\Http\Controllers\DashboardController@dealerDashboard')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class, \App\Http\Middleware\EnsureRole::class.':dealer'])
    ->name('dealer.dashboard');

// Order Detail (protected route for dealers)
Route::get('/order/{orderId}', 'App\Http\Controllers\DashboardController@orderDetail')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class, \App\Http\Middleware\EnsureRole::class.':dealer'])
    ->name('order.detail');

// Promotions listing (protected route)
Route::get('/promotions', 'App\Http\Controllers\DashboardController@promotions')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])
    ->name('promotions.index');

// Products listing (protected route)
Route::get('/products', 'App\Http\Controllers\DashboardController@products')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])
    ->name('products.index');

// Product detail (protected route)
Route::get('/product/{productId}', 'App\Http\Controllers\DashboardController@productDetail')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])
    ->name('product.detail');

// Promotion detail (protected route)
Route::get('/promotion/{promotion}', 'App\Http\Controllers\DashboardController@showPromotion')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])
    ->name('promotion.show');

// Articles listing (protected route)
Route::get('/articles', 'App\Http\Controllers\DashboardController@articles')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])
    ->name('articles.index');

// Article detail (protected route)
Route::get('/article/{article}', 'App\Http\Controllers\DashboardController@showArticle')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])
    ->name('article.show');

// Service detail (protected route)
Route::get('/service/{serviceType}', 'App\Http\Controllers\DashboardController@showService')
    ->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])
    ->name('service.show');

// Admin Authentication Routes (No middleware)
Route::prefix('control-panel')->name('admin.')->group(function () {
    Route::get('/login', 'App\Http\Controllers\Admin\AuthController@showLoginForm')->name('login');
    Route::post('/login', 'App\Http\Controllers\Admin\AuthController@login')->name('login.submit');
    Route::post('/logout', 'App\Http\Controllers\Admin\AuthController@logout')->name('logout');
});

// Admin Routes (Role-based access)
Route::prefix('control-panel')->name('admin.')->middleware(['auth', \App\Http\Middleware\EnsureRole::class.':admin'])->group(function () {
    // Admin Dashboard
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');

    // Promotion Management
    Route::resource('promotions', 'App\Http\Controllers\Admin\PromotionController');

    // Article Management
    Route::resource('articles', 'App\Http\Controllers\Admin\ArticleController');

    // Product Management
    Route::resource('products', 'App\Http\Controllers\Admin\ProductController');

    // Service Management
    Route::resource('services', 'App\Http\Controllers\Admin\ServiceController');

    // User Management
    Route::resource('users', 'App\Http\Controllers\Admin\UserController')->except(['create', 'store', 'show']);
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();

    return redirect('/');
})->name('logout');
