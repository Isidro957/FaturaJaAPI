<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizacoesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formularios', function () {
    return view('form-models');
});

Auth::routes();

Route::resource('/organization', OrganizacoesController::class);
Route::get('/organization/create', [OrganizacoesController::class, 'create'])->name('organization.create');
Route::post('/organization/create', [OrganizacoesController::class, 'store'])->name('organization.store');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
