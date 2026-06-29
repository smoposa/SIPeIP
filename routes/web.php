<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObjetivoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Usuarios
    Route::prefix('usuarios')->group(function () {

        Route::get('/', [UserController::class, 'listar'])
            ->name('usuarios.index');

        Route::get('/crear', [UserController::class, 'crear'])
            ->name('usuarios.create');

        Route::post('/guardar', [UserController::class, 'store'])
            ->name('usuarios.store');

        Route::get('/desactivados', [UserController::class, 'desactivados'])
            ->name('usuarios.desactivados');

        Route::get('/{usuario}', [UserController::class, 'detalle'])
            ->name('usuarios.show');
        
        Route::put('/{usuario}', [UserController::class, 'update'])
            ->name('usuarios.update');

        Route::get('/{usuario}/editar', [UserController::class, 'editar'])
            ->name('usuarios.edit');

        Route::get('/{usuario}/estado', [UserController::class, 'editarEstado'])
            ->name('usuarios.estado');

        Route::put('/{usuario}/actualizar-estado', [UserController::class, 'actualizarEstado'])
            ->name('usuarios.actualizarestado');

        Route::get('/usuarios/{id}/editar-rol',
            [UserController::class, 'editRoles'])
            ->name('usuarios.editroles');

        Route::put('/usuarios/{id}/actualizar-rol',
            [UserController::class, 'updateRoles'])
            ->name('usuarios.actualizarroles');

        Route::get('/{usuario}/editar-entidad',
            [UserController::class, 'editEntidad'])
            ->name('usuarios.editentidad');

        Route::put('/{usuario}/actualizar-entidad',
            [UserController::class, 'updateEntidad'])
            ->name('usuarios.actualizarentidad');

        Route::get('/{usuario}/restablecer-password',
            [UserController::class, 'editPassword'])
            ->name('usuarios.editpassword');

        Route::put('/{usuario}/actualizar-password',
            [UserController::class, 'updatePassword'])
            ->name('usuarios.actualizarpassword');

    });

    // Roles
    Route::prefix('roles')->group(function () {

        Route::get('/', [RoleController::class, 'index'])
            ->name('roles.index');

        Route::get('/listar', [RoleController::class, 'listar'])
            ->name('roles.listar');

        Route::get('/crear', [RoleController::class, 'create'])
            ->name('roles.create');

        Route::get('/{id}/detalle', [RoleController::class, 'detalle'])
            ->name('roles.detalle');

        Route::post('/guardar', [RoleController::class, 'store'])
            ->name('roles.store');

        Route::get('/{id}/editar', [RoleController::class, 'edit'])
            ->name('roles.edit');

        Route::put('/{id}', [RoleController::class, 'update'])
            ->name('roles.update');

        Route::get('/desactivados', [RoleController::class, 'desactivados'])
            ->name('roles.desactivados');

    });

    // Entidades
    Route::prefix('entidades')->group(function () {

        Route::get('/', [EntidadController::class, 'index'])
            ->name('entidades.index');

        Route::get('/listar', [EntidadController::class, 'listar'])
            ->name('entidades.listar');

        Route::get('/crear', [EntidadController::class, 'create'])
            ->name('entidades.create');

        Route::post('/guardar', [EntidadController::class, 'store'])
            ->name('entidades.store');

        Route::get('/{id}/detalle', [EntidadController::class, 'detalle'])
            ->name('entidades.detalle');

        Route::get('/{id}/editar', [EntidadController::class, 'edit'])
            ->name('entidades.edit');

        Route::put('/{id}', [EntidadController::class, 'update'])
            ->name('entidades.update');

        Route::get('/{id}/editar-estado', [EntidadController::class, 'editarEstado'])
            ->name('entidades.editarestado');

        Route::put('/{id}/actualizar-estado', [EntidadController::class, 'actualizarEstado'])
            ->name('entidades.actualizarestado');

    });

    // Planes
    Route::prefix('planes')->name('planes.')->group(function () {

        Route::get('/', [PlanController::class, 'index'])->name('index');

        Route::get('/create', [PlanController::class, 'create'])->name('create');

        Route::post('/', [PlanController::class, 'store'])->name('store');

        Route::get('/listar', [PlanController::class, 'listar'])->name('listar');

        Route::get('/{id}', [PlanController::class, 'detalle'])->name('detalle');

        Route::get('/{id}/editar', [PlanController::class, 'edit'])->name('edit');

        Route::put('/{id}', [PlanController::class, 'update'])->name('update');

        Route::delete('/{id}', [PlanController::class, 'destroy'])->name('destroy');

    });

    // Objetivos 
    Route::prefix('objetivos')->name('objetivos.')->group(function () {

        // Información General
        Route::get('/', [ObjetivoController::class, 'index'])->name('index');

        // Objetivos de Desarrollo Sostenible (ODS)
        Route::get('/ods', [ObjetivoController::class, 'ods'])->name('ods');

        // Plan Nacional de Desarrollo (PND)
        Route::get('/pnd', [ObjetivoController::class, 'pnd'])->name('pnd');

        // Objetivos Estratégicos Institucionales (OEI)
        Route::get('/oei', [ObjetivoController::class, 'oei'])->name('oei');

        Route::get('/ods/create', [ObjetivoController::class, 'createODS'])->name('createODS');

        Route::get('/pnd/create', [ObjetivoController::class, 'createPND'])->name('createPND');

        Route::get('/oei/create', [ObjetivoController::class, 'createOEI'])->name('createOEI');

        Route::post('/', [ObjetivoController::class, 'store'])->name('store');

        // Detalle del Objetivo Institucional
        Route::get('/detalle/{id}', [ObjetivoController::class, 'detalle'])->name('detalle');

    });

});

require __DIR__.'/auth.php';