<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
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
        Route::prefix('planes')->group(function () {

            Route::get('/', [PlanController::class, 'index'])
                ->name('planes.index');

            Route::get('/listar', [PlanController::class, 'listar'])
                ->name('planes.listar');

            Route::get('/crear', [PlanController::class, 'create'])
                ->name('planes.create');

            Route::post('/guardar', [PlanController::class, 'store'])
                ->name('planes.store');

            Route::get('/{plan}/editar', [PlanController::class, 'editar'])
                ->name('planes.editar');

            Route::put('/{plan}/actualizar', [PlanController::class, 'update'])
                ->name('planes.actualizar');

            Route::put('/{plan}/desactivar', [PlanController::class, 'destroy'])
                ->name('planes.destroy');

            Route::get('/{plan}/detalle', [PlanController::class, 'detalle'])
                ->name('planes.detalle');

        });


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
});

require __DIR__.'/auth.php';