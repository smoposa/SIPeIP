<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\ProgramaController;

use App\Http\Controllers\OdsController;
use App\Http\Controllers\PndController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\IndicadorController;

// Página principal
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

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

    // Objetivos
    Route::prefix('objetivos')
        ->middleware('role:objetivos')
        ->group(function () {

            Route::get('/', [ObjetivoController::class, 'index'])
                ->name('objetivos.index');

            Route::get('/listar', [ObjetivoController::class, 'listar'])
                ->name('objetivos.listar');

            Route::get('/crear', [ObjetivoController::class, 'create'])
                ->name('objetivos.create');

            Route::post('/crear', [ObjetivoController::class, 'store'])
                ->name('objetivos.store');

            // ================= AJAX =================
            Route::get('/pnd/{pnd}/politicas',
                [ObjetivoController::class, 'obtenerPoliticas'])
                ->name('objetivos.pnd.politicas');

            Route::get('/{id}/detalle', [ObjetivoController::class, 'detalle'])
                ->name('objetivos.detalle');

            Route::get('/{id}/editar', [ObjetivoController::class, 'edit'])
                ->name('objetivos.edit');

            Route::put('/{id}/editar', [ObjetivoController::class, 'update'])
                ->name('objetivos.update');

            Route::get('/{id}/estado', [ObjetivoController::class, 'editarEstado'])
                ->name('objetivos.editarestado');

            Route::put('/{id}/estado', [ObjetivoController::class, 'actualizarEstado'])
                ->name('objetivos.actualizarestado');

            Route::get(
                '/ods/{ods}/metas',
                [ObjetivoController::class, 'obtenerMetasOds']
            )->name('objetivos.ods.metas');

    });

    // Planificación Nacional
    Route::prefix('planes')
        ->middleware('role:planes')
        ->group(function () {

            Route::get('/', [PlanController::class, 'index'])
                ->name('planes.index');

            Route::get('/listar', [PlanController::class, 'listar'])
                ->name('planes.listar');

            Route::get('/crear', [PlanController::class, 'create'])
                ->name('planes.create');

            Route::post('/crear', [PlanController::class, 'store'])
                ->name('planes.store');

            Route::get('/{id}/detalle', [PlanController::class, 'detalle'])
                ->name('planes.detalle');

            Route::get('/{id}/editar', [PlanController::class, 'edit'])
                ->name('planes.edit');

            Route::put('/{id}/editar', [PlanController::class, 'update'])
                ->name('planes.update');

            Route::get('/{id}/estado', [PlanController::class, 'editarEstado'])
                ->name('planes.editarestado');

            Route::put('/{id}/estado', [PlanController::class, 'actualizarEstado'])
                ->name('planes.actualizarestado');

            // Finalización del asistente
            Route::get('/finalizado', [PlanController::class, 'finalizado'])
                ->name('planes.finalizado');

        });

    });

    // Metas
    Route::prefix('metas')->name('metas.')->group(function () {

        Route::get('/', [MetaController::class, 'index'])
            ->name('index');

        Route::get('/listar', [MetaController::class, 'listar'])
            ->name('listar');

        Route::get('/crear', [MetaController::class, 'create'])
            ->name('create');

        Route::post('/guardar', [MetaController::class, 'store'])
            ->name('store');

        Route::get('/{id}/detalle', [MetaController::class, 'detalle'])
            ->name('detalle');

        Route::get('/{id}/editar', [MetaController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}', [MetaController::class, 'update'])
            ->name('update');

        Route::patch('/{id}/estado', [MetaController::class, 'cambiarEstado'])
            ->name('estado');

    });

    // Indicadores
    Route::prefix('indicadores')->group(function () {

        Route::get('/listar', [IndicadorController::class, 'listar'])
            ->name('indicadores.listar');

        Route::get('/crear', [IndicadorController::class, 'create'])
            ->name('indicadores.create');

        Route::post('/guardar', [IndicadorController::class, 'store'])
            ->name('indicadores.store');

        Route::get('/detalle/{id}', [IndicadorController::class, 'detalle'])
            ->name('indicadores.detalle');

        Route::get('/editar/{id}', [IndicadorController::class, 'editar'])
            ->name('indicadores.edit');

        Route::put('/actualizar/{id}', [IndicadorController::class, 'update'])
            ->name('indicadores.update');

        Route::patch('/estado/{id}', [IndicadorController::class, 'cambiarEstado'])
            ->name('indicadores.estado');

    });

    // Programas
    Route::prefix('programas')
        ->name('programas.')
        ->controller(ProgramaController::class)
        ->group(function () {

            Route::get('/', 'listar')
                ->name('listar');

            Route::get('/crear', 'create')
                ->name('create');

            Route::post('/crear', 'store')
                ->name('store');

            Route::get('/detalle/{id}', 'detalle')
                ->name('detalle');

            Route::get('/editar/{id}', 'edit')
                ->name('edit');

            Route::put('/editar/{id}', 'update')
                ->name('update');

            Route::patch('/estado/{id}', 'editarEstado')
                ->name('estado');

    });


require __DIR__.'/auth.php';