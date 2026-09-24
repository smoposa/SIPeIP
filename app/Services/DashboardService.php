<?php

namespace App\Services;

use App\Models\{Avance, Indicador, Meta, Objetivo, Ods, Plan, PndObjetivo, Presupuesto, Programa, Proyecto, User};

class DashboardService
{
    public function datos(User $usuario): array
    {
        $entidadId = $usuario->entidad_id;
        $tarjetas = [];
        $catalogos = [];
        $accesos = [];
        $recientes = [];

        // Se usan exactamente los permisos que rigen los módulos y el menú.
        // Nunca se ejecuta una consulta institucional sin entidad asignada.
        $modulos = [
            'planes' => ['Planes institucionales', 'planes.listar', 'bi-journal-text'],
            'objetivos' => ['Objetivos estratégicos', 'objetivos.listar', 'bi-bullseye'],
            'metas' => ['Metas institucionales', 'metas.listar', 'bi-flag'],
            'indicadores' => ['Indicadores', 'indicadores.listar', 'bi-graph-up'],
            'programas' => ['Programas de inversión', 'programas.listar', 'bi-diagram-3'],
            'proyectos' => ['Proyectos de inversión', 'proyectos.listar', 'bi-building'],
            'avances' => ['Registros de avance', 'avances.listar', 'bi-clipboard-check'],
            'presupuestos' => ['Registros presupuestarios', 'presupuestos.listar', 'bi-cash-stack'],
        ];

        foreach ($modulos as $modulo => [$nombre, $ruta, $icono]) {
            if (!puedeVer($modulo)) {
                continue;
            }
            $accesos[] = compact('nombre', 'ruta', 'icono');
            if ($entidadId === null) {
                continue;
            }
            $total = match ($modulo) {
                'planes' => Plan::where('entidad_id', $entidadId)->count(),
                'objetivos' => Objetivo::whereHas('plan', fn ($q) => $q->where('entidad_id', $entidadId))->count(),
                'metas' => Meta::whereHas('objetivo.plan', fn ($q) => $q->where('entidad_id', $entidadId))->count(),
                'indicadores' => Indicador::whereHas('meta.objetivo.plan', fn ($q) => $q->where('entidad_id', $entidadId))->count(),
                'programas' => Programa::where('entidad_id', $entidadId)->count(),
                'proyectos' => Proyecto::where('entidad_id', $entidadId)->count(),
                'avances' => Avance::where('entidad_id', $entidadId)->count(),
                'presupuestos' => Presupuesto::where('entidad_id', $entidadId)->count(),
            };
            $tarjetas[] = compact('nombre', 'ruta', 'icono', 'total');
        }

        if ($entidadId !== null && puedeVer('proyectos')) {
            $recientes = Proyecto::query()->where('entidad_id', $entidadId)
                ->orderByDesc('id')->limit(5)->get(['id', 'codigo', 'nombre', 'estado_proceso']);
        } elseif ($entidadId !== null && puedeVer('planes')) {
            $recientes = Plan::query()->where('entidad_id', $entidadId)
                ->orderByDesc('id')->limit(5)->get(['id', 'codigo', 'nombre', 'estado_proceso']);
        }

        $otros = [
            'ods' => ['ODS', 'ods.index', 'bi-globe-americas'],
            'pnd' => ['Plan Nacional de Desarrollo', 'pnd.index', 'bi-map'],
            'clasificacion_inversion' => ['Clasificación de inversión', 'clasificacion-inversion.index', 'bi-list-nested'],
            'reportes' => ['Reportes', 'reportes.index', 'bi-bar-chart-line'],
            'usuarios' => ['Usuarios', 'usuarios.index', 'bi-people'],
            'entidades' => ['Entidades', 'entidades.index', 'bi-buildings'],
            'roles' => ['Roles', 'roles.index', 'bi-person-gear'],
        ];
        foreach ($otros as $modulo => [$nombre, $ruta, $icono]) {
            if (puedeVer($modulo)) {
                $accesos[] = compact('nombre', 'ruta', 'icono');
            }
        }

        // Los catálogos son nacionales y su total se identifica como global.
        if (puedeVer('ods')) {
            $catalogos[] = ['nombre' => 'Objetivos ODS', 'ruta' => 'ods.index',
                'icono' => 'bi-globe-americas', 'total' => Ods::count()];
        }
        if (puedeVer('pnd')) {
            $catalogos[] = ['nombre' => 'Objetivos PND', 'ruta' => 'pnd.index',
                'icono' => 'bi-map', 'total' => PndObjetivo::count()];
        }
        if ($entidadId !== null && puedeVer('usuarios')) {
            $tarjetas[] = ['nombre' => 'Usuarios de la entidad', 'ruta' => 'usuarios.index',
                'icono' => 'bi-people', 'total' => User::where('entidad_id', $entidadId)->count()];
        }

        return [
            'usuario' => $usuario,
            'tarjetas' => $tarjetas,
            'catalogos' => $catalogos,
            'accesos' => $accesos,
            'recientes' => $recientes,
            'tipoRecientes' => puedeVer('proyectos') ? 'proyectos' : 'planes',
        ];
    }
}
