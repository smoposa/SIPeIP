<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntidadController;

use App\Http\Controllers\OdsController;
use App\Http\Controllers\PndController;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Configuración Institucional
    |--------------------------------------------------------------------------
    */

    // Roles
    Route::prefix('roles')
        ->middleware('role:roles')
        ->group(function () {

            Route::get('/', [RoleController::class, 'index'])
                ->name('roles.index');

            Route::get('/listar', [RoleController::class, 'listar'])
                ->name('roles.listar');

            Route::get('/crear', [RoleController::class, 'create'])
                ->name('roles.create');

            Route::post('/guardar', [RoleController::class, 'store'])
                ->name('roles.store');

            Route::get('/{id}/detalle', [RoleController::class, 'detalle'])
                ->name('roles.detalle');

            Route::get('/{id}/editar', [RoleController::class, 'edit'])
                ->name('roles.edit');

            Route::put('/{id}', [RoleController::class, 'update'])
                ->name('roles.update');

            Route::get('/{id}/estado', [RoleController::class, 'editarEstado'])
                ->name('roles.estado');

            Route::put('/{id}/estado', [RoleController::class, 'actualizarEstado'])
                ->name('roles.actualizarestado');

        });

    // Usuarios
    Route::prefix('usuarios')
        ->middleware('role:usuarios')
        ->group(function () {

            Route::get('/', [UserController::class, 'index'])
                ->name('usuarios.index');

            Route::get('/listar', [UserController::class, 'listar'])
                ->name('usuarios.listar');

            Route::get('/crear', [UserController::class, 'crear'])
                ->name('usuarios.create');

            Route::post('/guardar', [UserController::class, 'store'])
                ->name('usuarios.store');

            Route::get('/{usuario}', [UserController::class, 'detalle'])
                ->name('usuarios.show');

            Route::get('/{usuario}/editar', [UserController::class, 'editar'])
                ->name('usuarios.edit');

            Route::put('/{usuario}', [UserController::class, 'update'])
                ->name('usuarios.update');

            Route::get('/{usuario}/estado', [UserController::class, 'editarEstado'])
                ->name('usuarios.estado');

            Route::put('/{usuario}/estado', [UserController::class, 'actualizarEstado'])
                ->name('usuarios.actualizarestado');

            Route::get('/{usuario}/editar-rol', [UserController::class, 'editRoles'])
                ->name('usuarios.editroles');

            Route::put('/{usuario}/editar-rol', [UserController::class, 'updateRoles'])
                ->name('usuarios.actualizarroles');

            Route::get('/{usuario}/editar-entidad', [UserController::class, 'editEntidad'])
                ->name('usuarios.editentidad');

            Route::put('/{usuario}/editar-entidad', [UserController::class, 'updateEntidad'])
                ->name('usuarios.actualizarentidad');

            Route::get('/{usuario}/password', [UserController::class, 'editPassword'])
                ->name('usuarios.editpassword');

            Route::put('/{usuario}/password', [UserController::class, 'updatePassword'])
                ->name('usuarios.actualizarpassword');

        });

    // Entidades
    Route::prefix('entidades')
        ->middleware('role:entidades')
        ->group(function () {

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

            Route::get('/{id}/estado', [EntidadController::class, 'editarEstado'])
                ->name('entidades.editarestado');

            Route::put('/{id}/estado', [EntidadController::class, 'actualizarEstado'])
                ->name('entidades.actualizarestado');

        });

    /*
    |--------------------------------------------------------------------------
    | Catálogos
    |--------------------------------------------------------------------------
    */

    // Objetivos de Desarrollo Sostenible
    Route::prefix('ods')
        ->group(function () {

            Route::get('/', [OdsController::class, 'index'])
                ->name('ods.index');

        });

    // Plan Nacional de Desarrollo
    Route::prefix('pnd')
        ->group(function () {

            Route::get('/', [PndController::class, 'index'])
                ->name('pnd.index');

        });

});

require __DIR__.'/auth.php';