<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizacoesController;
use App\Http\Controllers\DocumentosController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/organization', OrganizacoesController::class);
Route::get('/organization/create', [OrganizacoesController::class, 'create'])->name('organization.create');
Route::post('/organization/create', [OrganizacoesController::class, 'store'])->name('organization.store');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rotas documentos
Route::get('/documentos/create', [DocumentosController::class, 'create'])->name('documentos.create');
Route::post('/documentos/create', [DocumentosController::class, 'store'])->name('documentos.store');
Route::get('/documentos/listar', [DocumentosController::class, 'index'])->name('documentos.listar');
Route::get('/documentos/editar/{id}', [DocumentosController::class, 'edit'])->name('documentos.editar');
Route::put('/documentos/{id}', [DocumentosController::class, 'update'])->name('documentos.update');
Route::delete('/documentos/{id}', [DocumentosController::class, 'destroy'])->name('documentos.destroy');
Route::get('/documentos/ver/{hash}', [DocumentosController::class, 'visualizar'])->name('documentos.visualizar');
