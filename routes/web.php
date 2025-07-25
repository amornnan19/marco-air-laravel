<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
});

// LINE Login Routes
Route::get('/auth/line', 'App\Http\Controllers\Auth\LineLoginController@redirectToProvider')->name('line.login');
Route::get('/auth/line/callback', 'App\Http\Controllers\Auth\LineLoginController@handleProviderCallback')->name('line.callback');

// Dashboard (protected route)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
