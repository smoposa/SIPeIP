<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EntidadController;
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

    });

});

require __DIR__.'/auth.php';