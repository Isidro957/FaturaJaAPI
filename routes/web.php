<?php
use App\Http\Controllers\Auth0Controller;
use Illuminate\Support\Facades\Route;

Route::get('/login', [Auth0Controller::class, 'showLoginPage'])->name('login');
Route::get('/auth/redirect/{provider}', [Auth0Controller::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback/{provider}', [Auth0Controller::class, 'callback'])->name('auth.callback');
Route::get('/logout', [Auth0Controller::class, 'logout'])->name('logout');

Route::middleware('auth0.web')->group(function () {
    Route::get('/dashboard', function () {
        $user = session('auth0_user');
        return view('dashboard', compact('user'));
    })->name('dashboard');
});
