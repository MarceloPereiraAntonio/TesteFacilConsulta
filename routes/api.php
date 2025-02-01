<?php

use App\Http\Controllers\{
    AuthController,
    CidadeController,
    ConsultaController,
    MedicoController,
    PacienteController,
};

use Illuminate\Support\Facades\Route;

//rotas publicas
Route::post('login', [AuthController::class, 'login']);
Route::get('/cidades', [CidadeController::class, 'index']);
Route::get('/medicos', [MedicoController::class, 'index']);
Route::get('cidades/{id_cidade}/medicos', [MedicoController::class, 'getMedicosByCidade']);

Route::middleware(['auth:api'])->group( function () {
    //login e autenticação
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'user']);
    //medicos
    Route::prefix('medicos')->name('medicos.')->group( function () {
        Route::post('/', [MedicoController::class, 'store']);
        //consultas
        Route::prefix('/consulta')->name('consultas.')->group( function () {
            Route::get('/', [ConsultaController::class, 'index']);
            Route::post('/', [ConsultaController::class, 'store']);
        });
        Route::get('/{id_medico}/pacientes', [PacienteController::class, 'getPacientesByMedico']);
    });
    //pacientes
    Route::prefix('pacientes')->name('pacientes.')->group( function () {
        Route::post('/', [PacienteController::class, 'store']);
        Route::put('/{id_paciente}', [PacienteController::class, 'update']);
    });
});