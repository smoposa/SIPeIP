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
use App\Http\Controllers\ProyectoController;

use App\Http\Controllers\ClasificacionInversionController;
use App\Http\Controllers\MacrosectorController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SubsectorController;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\DashboardController;

// Página principal
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware([
    'auth',
    'verified',
    'sesion.activa',
])->name('dashboard');

// Rutas protegidas
Route::middleware([
    'auth',
    'sesion.activa',
])->group(function () {

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

            Route::get('/crear', [RoleController::class, 'create'])
                ->name('roles.create');

            Route::get('/asignacion', [RoleController::class, 'asignacion'])
                ->name('roles.asignacion');

            Route::put('/asignacion', [RoleController::class, 'actualizarAsignacion'])
                ->name('roles.actualizarasignacion');

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

            // Información general
            Route::get('/', [UserController::class, 'index'])
                ->name('usuarios.index');

            // Crear
            Route::get('/crear', [UserController::class, 'crear'])
                ->name('usuarios.create');

            Route::post('/guardar', [UserController::class, 'store'])
                ->name('usuarios.store');

            // Detalle
            Route::get('/{usuario}', [UserController::class, 'detalle'])
                ->name('usuarios.show');

            // Editar información
            Route::get('/{usuario}/editar', [UserController::class, 'editar'])
                ->name('usuarios.edit');

            Route::put('/{usuario}', [UserController::class, 'update'])
                ->name('usuarios.update');

            // Estado
            Route::get('/{usuario}/estado', [UserController::class, 'editarEstado'])
                ->name('usuarios.estado');

            Route::put('/{usuario}/estado', [UserController::class, 'actualizarEstado'])
                ->name('usuarios.actualizarestado');

            // Rol
            Route::get('/{usuario}/editar-rol', [UserController::class, 'editRoles'])
                ->name('usuarios.editroles');

            Route::put('/{usuario}/editar-rol', [UserController::class, 'updateRoles'])
                ->name('usuarios.actualizarroles');

            // Entidad
            Route::get('/{usuario}/editar-entidad', [UserController::class, 'editEntidad'])
                ->name('usuarios.editentidad');

            Route::put('/{usuario}/editar-entidad', [UserController::class, 'updateEntidad'])
                ->name('usuarios.actualizarentidad');

            // Contraseña
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

    // Gestión de catálogos: controlador, validación, servicio y repositorio.
    Route::prefix('catalogos/gestion/{recurso}')
        ->name('catalogos.gestion.')
        ->controller(\App\Http\Controllers\GestionCatalogoController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/crear', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/detalle', 'show')->whereNumber('id')->name('show');
            Route::get('/{id}/editar', 'edit')->whereNumber('id')->name('edit');
            Route::put('/{id}', 'update')->whereNumber('id')->name('update');
            Route::put('/{id}/estado', 'estado')->whereNumber('id')->name('estado');
        });

    // Objetivos de Desarrollo Sostenible
    Route::prefix('ods')
        ->middleware('role:ods')
        ->group(function () {

            // Agendas: listado y panel lateral
            Route::get('/', [OdsController::class, 'index'])
                ->name('ods.agendas.index');

            // Agendas: registrar
            Route::post('/agendas', [OdsController::class, 'store'])
                ->name('ods.agendas.store');

            // Agendas: actualizar información y estado
            Route::put('/agendas/{agenda}', [OdsController::class, 'update'])
                ->whereNumber('agenda')
                ->name('ods.agendas.update');


            // Objetivos: listado por agenda y panel lateral
            Route::get('/agendas/{agenda}/objetivos', [OdsController::class, 'listarObjetivos'])
                ->whereNumber('agenda')
                ->name('ods.objetivos.index');

            // Objetivos: registrar
            Route::post('/agendas/{agenda}/objetivos', [OdsController::class, 'guardarObjetivo'])
                ->whereNumber('agenda')
                ->name('ods.objetivos.store');

            // Objetivos: actualizar información y estado
            Route::put('/objetivos/{ods}', [OdsController::class, 'actualizarObjetivo'])
                ->whereNumber('ods')
                ->name('ods.objetivos.update');


            // Metas: listado por objetivo y panel lateral
            Route::get('/objetivos/{ods}/metas', [OdsController::class, 'listarMetas'])
                ->whereNumber('ods')
                ->name('ods.metas.index');

            // Metas: registrar
            Route::post(
                '/objetivos/{ods}/metas',
                [\App\Http\Controllers\OdsMetaController::class, 'store']
            )
                ->whereNumber('ods')
                ->name('ods.metas.store');

            // Metas: actualizar información y estado
            Route::put(
                '/objetivos/{ods}/metas/{meta}',
                [\App\Http\Controllers\OdsMetaController::class, 'update']
            )
                ->whereNumber('ods')
                ->whereNumber('meta')
                ->name('ods.metas.update');

    });


    // Plan Nacional de Desarrollo
    Route::prefix('pnd')
        ->middleware('role:pnd')
        ->name('pnd.')
        ->group(function () {

            Route::get('/', [PndController::class, 'index'])
                ->name('index');

            Route::post('/planes', [PndController::class, 'store'])
                ->name('planes.store');

            Route::put('/planes/{pnd}', [PndController::class, 'update'])
                ->whereNumber('pnd')
                ->name('planes.update');

            Route::post(
                '/objetivos/{objetivo}/politicas',
                [\App\Http\Controllers\PndPoliticaController::class, 'store']
            )
                ->whereNumber('objetivo')
                ->name('politicas.store');

            Route::put(
                '/objetivos/{objetivo}/politicas/{politica}',
                [\App\Http\Controllers\PndPoliticaController::class, 'update']
            )
                ->whereNumber('objetivo')
                ->whereNumber('politica')
                ->name('politicas.update');

            Route::post(
                '/objetivos/{objetivo}/politicas/{politica}/estrategias',
                [\App\Http\Controllers\PndEstrategiaController::class, 'store']
            )
                ->whereNumber('objetivo')
                ->whereNumber('politica')
                ->name('estrategias.store');

            Route::put(
                '/objetivos/{objetivo}/politicas/{politica}/estrategias/{estrategia}',
                [\App\Http\Controllers\PndEstrategiaController::class, 'update']
            )
                ->whereNumber('objetivo')
                ->whereNumber('politica')
                ->whereNumber('estrategia')
                ->name('estrategias.update');

            Route::post(
                '/objetivos/{objetivo}/metas',
                [\App\Http\Controllers\PndMetaController::class, 'store']
            )
                ->whereNumber('objetivo')
                ->name('metas.store');

            Route::put(
                '/objetivos/{objetivo}/metas/{meta}',
                [\App\Http\Controllers\PndMetaController::class, 'update']
            )
                ->whereNumber('objetivo')
                ->whereNumber('meta')
                ->name('metas.update');

            Route::post(
                '/ejes/{eje}/objetivos',
                [\App\Http\Controllers\PndObjetivoController::class, 'store']
            )
                ->whereNumber('eje')
                ->name('objetivos.store');

            Route::put(
                '/objetivos/{objetivo}',
                [\App\Http\Controllers\PndObjetivoController::class, 'update']
            )
                ->whereNumber('objetivo')
                ->name('objetivos.update');

            Route::get('/planes/{pnd}/ejes', [PndController::class, 'listarEjes'])
                ->whereNumber('pnd')
                ->name('ejes.index');

            Route::post(
                '/planes/{pnd}/ejes',
                [\App\Http\Controllers\PndEjeController::class, 'store']
            )
                ->whereNumber('pnd')
                ->name('ejes.store');

            Route::put(
                '/ejes/{eje}',
                [\App\Http\Controllers\PndEjeController::class, 'update']
            )
                ->whereNumber('eje')
                ->name('ejes.update');

            Route::get(
                '/ejes/{eje}/objetivos',
                [PndController::class, 'listarObjetivos']
            )
                ->whereNumber('eje')
                ->name('objetivos.index');

            Route::get('/objetivos/{id}', [PndController::class, 'objetivo'])
                ->whereNumber('id')
                ->name('objetivo');

    });


    /*
    |--------------------------------------------------------------------------
    | Catálogo: Clasificación de la inversión
    |--------------------------------------------------------------------------
    */

    Route::prefix('catalogos/clasificacion-inversion')
        ->name('clasificacion-inversion.')
        ->middleware('role:clasificacion_inversion')
        ->group(function () {

            // Listado de macrosectores.
            Route::get('/', [ClasificacionInversionController::class, 'index'])
                ->name('index');


            /*
            |--------------------------------------------------------------------------
            | Listados por nivel
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/macrosectores/{macrosector}',
                [SectorController::class, 'index']
            )
                ->whereNumber('macrosector')
                ->name('sectores.index');

            Route::get(
                '/sectores/{sector}',
                [SubsectorController::class, 'index']
            )
                ->whereNumber('sector')
                ->name('subsectores.index');


            /*
            |--------------------------------------------------------------------------
            | Panel lateral: macrosectores
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/panel/macrosectores',
                [MacrosectorController::class, 'storePanel']
            )
                ->name('macrosectores.panel.store');

            Route::put(
                '/panel/macrosectores/{macrosector}',
                [MacrosectorController::class, 'updatePanel']
            )
                ->whereNumber('macrosector')
                ->name('macrosectores.panel.update');


            /*
            |--------------------------------------------------------------------------
            | Panel lateral: sectores
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/macrosectores/{macrosector}/sectores',
                [SectorController::class, 'storePanel']
            )
                ->whereNumber('macrosector')
                ->name('sectores.panel.store');

            Route::put(
                '/panel/sectores/{sector}',
                [SectorController::class, 'updatePanel']
            )
                ->whereNumber('sector')
                ->name('sectores.panel.update');


            /*
            |--------------------------------------------------------------------------
            | Panel lateral: subsectores
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/sectores/{sector}/subsectores',
                [SubsectorController::class, 'storePanel']
            )
                ->whereNumber('sector')
                ->name('subsectores.panel.store');

            Route::put(
                '/panel/subsectores/{subsector}',
                [SubsectorController::class, 'updatePanel']
            )
                ->whereNumber('subsector')
                ->name('subsectores.panel.update');


            /*
            |--------------------------------------------------------------------------
            | Formularios anteriores: macrosectores
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/macrosectores/crear',
                [MacrosectorController::class, 'create']
            )
                ->name('macrosectores.create');

            Route::post(
                '/macrosectores',
                [MacrosectorController::class, 'store']
            )
                ->name('macrosectores.store');

            Route::get(
                '/macrosectores/{macrosector}/editar',
                [MacrosectorController::class, 'edit']
            )
                ->whereNumber('macrosector')
                ->name('macrosectores.edit');

            Route::put(
                '/macrosectores/{macrosector}',
                [MacrosectorController::class, 'update']
            )
                ->whereNumber('macrosector')
                ->name('macrosectores.update');

            Route::put(
                '/macrosectores/{macrosector}/estado',
                [MacrosectorController::class, 'actualizarEstado']
            )
                ->whereNumber('macrosector')
                ->name('macrosectores.estado');


            /*
            |--------------------------------------------------------------------------
            | Formularios anteriores: sectores
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/sectores/crear',
                [SectorController::class, 'create']
            )
                ->name('sectores.create');

            Route::post(
                '/sectores',
                [SectorController::class, 'store']
            )
                ->name('sectores.store');

            Route::get(
                '/sectores/{sector}/editar',
                [SectorController::class, 'edit']
            )
                ->whereNumber('sector')
                ->name('sectores.edit');

            Route::put(
                '/sectores/{sector}',
                [SectorController::class, 'update']
            )
                ->whereNumber('sector')
                ->name('sectores.update');

            Route::put(
                '/sectores/{sector}/estado',
                [SectorController::class, 'actualizarEstado']
            )
                ->whereNumber('sector')
                ->name('sectores.estado');


            /*
            |--------------------------------------------------------------------------
            | Formularios anteriores: subsectores
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/subsectores/crear',
                [SubsectorController::class, 'create']
            )
                ->name('subsectores.create');

            Route::post(
                '/subsectores',
                [SubsectorController::class, 'store']
            )
                ->name('subsectores.store');

            Route::get(
                '/subsectores/{subsector}/editar',
                [SubsectorController::class, 'edit']
            )
                ->whereNumber('subsector')
                ->name('subsectores.edit');

            Route::put(
                '/subsectores/{subsector}',
                [SubsectorController::class, 'update']
            )
                ->whereNumber('subsector')
                ->name('subsectores.update');

            Route::put(
                '/subsectores/{subsector}/estado',
                [SubsectorController::class, 'actualizarEstado']
            )
                ->whereNumber('subsector')
                ->name('subsectores.estado');


            /*
            |--------------------------------------------------------------------------
            | Consultas JSON para selectores
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/macrosectores/{macrosector}/sectores',
                [SectorController::class, 'porMacrosector']
            )
                ->whereNumber('macrosector')
                ->name('macrosectores.sectores');

            Route::get(
                '/sectores/{sector}/subsectores',
                [SubsectorController::class, 'porSector']
            )
                ->whereNumber('sector')
                ->name('sectores.subsectores');
    });

    
    // Objetivos
    Route::prefix('objetivos')
        ->middleware('role:objetivos')
        ->group(function () {

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

        });

    
    // Metas
    Route::prefix('metas')
        ->middleware('role:metas')
        ->group(function () {

            Route::get('/listar', [MetaController::class, 'listar'])
                ->name('metas.listar');

            Route::get('/crear', [MetaController::class, 'create'])
                ->name('metas.create');

            Route::post('/crear', [MetaController::class, 'store'])
                ->name('metas.store');

            Route::get('/{id}/detalle', [MetaController::class, 'detalle'])
                ->name('metas.detalle');

            Route::get('/{id}/editar', [MetaController::class, 'edit'])
                ->name('metas.edit');

            Route::put('/{id}/editar', [MetaController::class, 'update'])
                ->name('metas.update');

            Route::get('/{id}/estado', [MetaController::class, 'editarEstado'])
                ->name('metas.editarestado');

            Route::put('/{id}/estado', [MetaController::class, 'actualizarEstado'])
                ->name('metas.actualizarestado');

        });


    // Indicadores
    Route::prefix('indicadores')
        ->middleware('role:indicadores')
        ->group(function () {

            Route::get('/listar', [IndicadorController::class, 'listar'])
                ->name('indicadores.listar');

            Route::get('/crear', [IndicadorController::class, 'create'])
                ->name('indicadores.create');

            Route::post('/crear', [IndicadorController::class, 'store'])
                ->name('indicadores.store');

            Route::get('/{id}/detalle', [IndicadorController::class, 'detalle'])
                ->name('indicadores.detalle');

            Route::get('/{id}/editar', [IndicadorController::class, 'edit'])
                ->name('indicadores.edit');

            Route::put('/{id}/editar', [IndicadorController::class, 'update'])
                ->name('indicadores.update');

            Route::get('/{id}/estado', [IndicadorController::class, 'editarEstado'])
                ->name('indicadores.editarestado');

            Route::put('/{id}/estado', [IndicadorController::class, 'actualizarEstado'])
                ->name('indicadores.actualizarestado');

        });

    /*
    |--------------------------------------------------------------------------
    | Programas de inversión pública
    |--------------------------------------------------------------------------
    */

    Route::prefix('programas')
        ->name('programas.')
        ->middleware('role:programas')
        ->controller(ProgramaController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('listar');

            Route::get('/crear', 'create')
                ->name('create');

            Route::post('/', 'store')
                ->name('store');

            Route::get('/{programa}/detalle', 'detalle')
                ->whereNumber('programa')
                ->name('detalle');

            Route::get('/{programa}/editar', 'edit')
                ->whereNumber('programa')
                ->name('edit');

            Route::put('/{programa}', 'update')
                ->whereNumber('programa')
                ->name('update');

            Route::put(
                '/{programa}/estado',
                'actualizarEstado'
            )
                ->whereNumber('programa')
                ->name('estado');

            Route::put(
                '/{programa}/estado-proceso',
                'actualizarEstadoProceso'
            )
                ->whereNumber('programa')
                ->name('estado-proceso');
    });

    /*
    |--------------------------------------------------------------------------
    | Proyectos de inversión pública
    |--------------------------------------------------------------------------
    */

    Route::prefix('proyectos')
        ->name('proyectos.')
        ->middleware('role:proyectos')
        ->controller(ProyectoController::class)
        ->group(function () {
            Route::get('/', 'index')
                ->name('listar');

            Route::get('/crear', 'create')
                ->name('create');

            Route::post('/', 'store')
                ->name('store');

            Route::get('/{proyecto}/detalle', 'detalle')
                ->name('detalle');

            Route::get('/{proyecto}/editar', 'edit')
                ->name('edit');

            Route::put('/{proyecto}', 'update')
                ->name('update');

            Route::put(
                '/{proyecto}/estado',
                'actualizarEstado'
            )->name('estado');

            Route::put(
                '/{proyecto}/estado-proceso',
                'actualizarEstadoProceso'
            )->name('estado-proceso');
    });

    // Seguimiento de avances
    Route::prefix('seguimiento/avances')
        ->name('avances.')
        ->middleware('role:avances')
        ->controller(AvanceController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('listar');

            Route::get('/crear', 'create')
                ->name('create');

            Route::post('/', 'store')
                ->name('store');

            Route::get('/proyectos/{proyecto}/indicadores', 'indicadores')
                ->whereNumber('proyecto')
                ->name('indicadores');

            Route::get('/{avance}/detalle', 'detalle')
                ->whereNumber('avance')
                ->name('detalle');

            Route::get('/{avance}/editar', 'edit')
                ->whereNumber('avance')
                ->name('edit');

            Route::put('/{avance}', 'update')
                ->whereNumber('avance')
                ->name('update');

        });


    // Seguimiento presupuestario
    Route::prefix('seguimiento/presupuestos')
        ->name('presupuestos.')
        ->middleware('role:presupuestos')
        ->controller(PresupuestoController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('listar');

            Route::get('/crear', 'create')
                ->name('create');

            Route::post('/', 'store')
                ->name('store');

            Route::get('/{presupuesto}/detalle', 'detalle')
                ->whereNumber('presupuesto')
                ->name('detalle');

            Route::get('/{presupuesto}/editar', 'edit')
                ->whereNumber('presupuesto')
                ->name('edit');

            Route::put('/{presupuesto}', 'update')
                ->whereNumber('presupuesto')
                ->name('update');

            // Reabrir un presupuesto cerrado.
            Route::put('/{presupuesto}/reabrir', 'reabrir')
                ->whereNumber('presupuesto')
                ->name('reabrir');

        });


    // Reportes
    Route::prefix('reportes')
        ->name('reportes.')
        ->middleware('role:reportes')
        ->controller(ReporteController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/excel', 'excel')
                ->name('excel');

            Route::get('/pdf', 'pdf')
                ->name('pdf');

        });

}); // Cierre del middleware auth

require __DIR__.'/auth.php';