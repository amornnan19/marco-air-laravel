<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // If user is authenticated, redirect to appropriate page
    if (Auth::check()) {
        $user = Auth::user();
        
        // Check if profile is incomplete
        if (empty($user->phone)) {
            return redirect()->route('profile.edit');
        }
        
        // Check if terms not accepted
        if (!$user->terms_accepted) {
            return redirect()->route('terms.show');
        }
        
        // Profile complete and terms accepted, go to dashboard
        return redirect()->route('dashboard');
    }
    
    // Not authenticated, show login page
    return view('login');
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
    return view('terms-conditions');
})->name('terms.conditions');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

Route::get('/cookie-policy', function () {
    return view('cookie-policy');
})->name('cookie.policy');

// Dashboard (protected route)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])->name('dashboard');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
