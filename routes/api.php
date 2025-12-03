<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth0Controller;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;

// -------------------------------------------------------
// ROTA PÚBLICA
// -------------------------------------------------------
Route::get('/', fn() => response()->json([
    'message' => 'API FacturaJá Online!',
]));

// -------------------------------------------------------
// AUTENTICAÇÃO AUTH0
// -------------------------------------------------------
Route::post('/auth/callback', [Auth0Controller::class, 'callback'])->name('auth.callback');

// -------------------------------------------------------
// ROTAS PROTEGIDAS (JWT Auth0)
// -------------------------------------------------------
Route::middleware(['auth0.jwt','tenant'])->group(function () {

    //-------------------------------------------------------
    // USUÁRIO / LOGOUT
    //-------------------------------------------------------
    Route::get('/user', [Auth0Controller::class, 'user'])
        ->name('user');

    Route::post('/logout', [Auth0Controller::class, 'logout'])
        ->name('logout');

    //-------------------------------------------------------
    // EMPRESAS (Admin apenas)
    //-------------------------------------------------------
    Route::apiResource('empresas', EmpresaController::class)
        ->middleware('checkRole:Admin');

        Route::apiResource('usuarios', UserController::class)
        ->middleware('checkRole:Admin');

    //-------------------------------------------------------
    // PRODUTOS (Admin + Empresa)
    //-------------------------------------------------------
    Route::apiResource('produtos', ProdutoController::class)
        ->middleware('checkRole:Admin,Empresa');

    //-------------------------------------------------------
    // CLIENTES (Admin + Empresa)
    //-------------------------------------------------------
    Route::apiResource('clientes', ClienteController::class)
        ->middleware('checkRole:Admin,Empresa');

    //-------------------------------------------------------
    // FATURAS (Admin + Empresa + Cliente)
    //-------------------------------------------------------
    Route::apiResource('faturas', FaturaController::class)
        ->middleware('checkRole:Admin,Empresa,Cliente');

    //-------------------------------------------------------
    // PAGAMENTOS (Admin + Empresa)
    //-------------------------------------------------------
    Route::apiResource('pagamentos', PagamentoController::class)
        ->middleware('checkRole:Admin,Empresa');

    //-------------------------------------------------------
    // EXPORTAÇÕES (PDF + EXCEL)
    //-------------------------------------------------------
    Route::prefix('export')->group(function() {

        // FATURAS
        Route::get('/faturas/{id}/pdf', [ExportController::class, 'faturaPdf'])
            ->middleware('checkRole:Admin,Empresa,Cliente')
            ->name('export.faturas.pdf');

        Route::get('/faturas/{id}/excel', [ExportController::class, 'faturaExcel'])
            ->middleware('checkRole:Admin,Empresa,Cliente')
            ->name('export.faturas.excel');

        Route::get('/faturas/todas', [ExportController::class, 'todasFaturasExcel'])
            ->middleware('checkRole:Admin,Empresa')
            ->name('export.faturas.todas');

        // PAGAMENTOS
        Route::get('/pagamentos/{id}/pdf', [ExportController::class, 'pagamentoPdf'])
            ->middleware('checkRole:Admin,Empresa')
            ->name('export.pagamentos.pdf');

        Route::get('/pagamentos/{id}/excel', [ExportController::class, 'pagamentoExcel'])
            ->middleware('checkRole:Admin,Empresa')
            ->name('export.pagamentos.excel');
    });
});
