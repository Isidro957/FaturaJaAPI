<?php

use App\Http\Controllers\Auth0Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('home');

Route::get('/login', [Auth0Controller::class, 'login'])->name('login');
Route::get('/callback', [Auth0Controller::class, 'callback'])->name('auth0.callback');
Route::get('/logout', [Auth0Controller::class, 'logout'])->name('logout');

Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
