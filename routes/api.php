<?php

use App\Http\Controllers\{
    AuthController,
    CidadeController,
    MedicoController,
};

use Illuminate\Support\Facades\Route;

//rotas publicas
Route::get('/cidades', [CidadeController::class, 'index']);
Route::get('/medicos', [MedicoController::class, 'index']);

Route::middleware(['api'])->group( function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'user']);
});