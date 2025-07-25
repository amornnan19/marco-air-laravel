<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
});

// LINE Login Routes
Route::get('/auth/line', 'App\Http\Controllers\Auth\LineLoginController@redirectToProvider')->name('line.login');
Route::get('/auth/line/callback', 'App\Http\Controllers\Auth\LineLoginController@handleProviderCallback')->name('line.callback');

// Profile update routes
Route::get('/update-profile', 'App\Http\Controllers\ProfileController@edit')->middleware('auth')->name('profile.edit');
Route::put('/update-profile', 'App\Http\Controllers\ProfileController@update')->middleware('auth')->name('profile.update');

// Dashboard (protected route)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', \App\Http\Middleware\EnsureProfileComplete::class])->name('dashboard');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
