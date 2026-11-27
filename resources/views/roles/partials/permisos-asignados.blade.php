<!-- Permisos y accesos -->
@php
    $permisosAsignados = $rol->permisos->groupBy('modulo');

    $modulos = [
        'dashboard' => 'Inicio',
        'roles' => 'Roles',
        'usuarios' => 'Usuarios',
        'entidades' => 'Entidades',
        'ods' => 'ODS',
        'pnd' => 'PND',
        'clasificacion_inversion' => 'Clasificación de la inversión',
        'planes' => 'Planes',
        'objetivos' => 'Objetivos',
        'metas' => 'Metas',
        'indicadores' => 'Indicadores',
        'programas' => 'Programas',
        'proyectos' => 'Proyectos',
        'avances' => 'Avances',
        'presupuestos' => 'Presupuestos',
        'reportes' => 'Reportes',
        'auditoria' => 'Auditoría',
    ];

    $acciones = [
        'ver' => 'Acceder',
        'crear' => 'Crear',
        'editar' => 'Editar',
        'estado' => 'Cambiar estado',
        'proceso' => 'Gestionar proceso',
        'reabrir' => 'Reabrir',
        'editarRol' => 'Editar rol',
        'editarEntidad' => 'Editar entidad',
        'editarPassword' => 'Editar contraseña',
    ];

    $categorias = [
        'dashboard' => 'Inicio',
        'roles' => 'Configuración',
        'usuarios' => 'Configuración',
        'entidades' => 'Configuración',
        'ods' => 'Catálogos',
        'pnd' => 'Catálogos',
        'clasificacion_inversion' => 'Catálogos',
        'planes' => 'Planificación Institucional',
        'objetivos' => 'Planificación Institucional',
        'metas' => 'Planificación Institucional',
        'indicadores' => 'Planificación Institucional',
        'programas' => 'Inversión Pública',
        'proyectos' => 'Inversión Pública',
        'avances' => 'Seguimiento',
        'presupuestos' => 'Seguimiento',
        'reportes' => 'Reportes',
        'auditoria' => 'Auditoría',
    ];

    $totalPermisos = $rol->permisos->count();

    $permisosAsignados = $permisosAsignados->sortBy(
        fn ($permisos, $modulo) => array_search($modulo, array_keys($modulos), true) !== false
            ? array_search($modulo, array_keys($modulos), true)
            : PHP_INT_MAX
    );
@endphp

<div class="mt-4 mb-6">

    <!-- Encabezado de permisos y accesos -->
    <div class="flex items-center justify-between bg-gray-100
                border-b border-gray-200 px-4 py-2
                text-sm font-medium text-gray-800">

        <span>Permisos y accesos</span>

        @if(puedeHacer('roles', 'editar'))

            <button
                type="button"
                data-editar-permisos-rol
                class="text-sm font-normal text-blue-500
                       hover:text-blue-800">

                Editar

            </button>

        @endif

    </div>


    <!-- Resumen de permisos -->
    <div class="flex flex-wrap items-center justify-between
                gap-3 px-4 py-4 text-sm">

        <p class="text-gray-600">
            Consulte los módulos y las acciones que este rol tiene permitidos.
        </p>

        <span class="text-xs text-gray-500">
            {{ $totalPermisos }}
            {{ $totalPermisos === 1 ? 'permiso asignado' : 'permisos asignados' }}
        </span>

    </div>


    <!-- Tabla de módulos y acciones -->
    <div class="mx-4 overflow-x-auto rounded-md border border-gray-200">

        <table class="w-full text-left text-sm">

            <thead class="bg-gray-50 border-b border-gray-200 text-gray-700">

                <tr>
                    <th scope="col" class="w-1/4 px-4 py-2 font-medium">Módulo</th>
                    <th scope="col" class="w-1/4 px-4 py-2 font-medium">Submenú</th>
                    <th scope="col" class="px-4 py-2 font-medium">Acciones permitidas</th>
                </tr>

            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse ($permisosAsignados as $modulo => $permisos)

                    <tr class="align-top">

                        <td class="px-4 py-3 text-gray-700">
                            {{ $categorias[$modulo] ?? $modulo }}
                        </td>

                        <td class="px-4 py-3 text-gray-700">
                            {{ ($categorias[$modulo] ?? null) === ($modulos[$modulo] ?? $modulo)
                                ? '—'
                                : ($modulos[$modulo] ?? $modulo) }}
                        </td>

                        <td class="px-4 py-3">

                            <div class="flex flex-wrap items-center gap-x-5 gap-y-2">

                                @foreach ($permisos as $permiso)

                                    <span class="text-xs text-gray-700">

                                        <i class="bi bi-check2 text-green-600"
                                           aria-hidden="true"></i>

                                        {{ $acciones[$permiso->accion] ?? $permiso->nombre }}

                                    </span>

                                @endforeach

                            </div>

                            @unless ($permisos->contains('accion', 'ver'))

                                <p class="mt-2 text-xs text-gray-500">
                                    Sin acceso al módulo
                                </p>

                            @endunless

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="px-4 py-4 text-gray-500">
                            Este rol no tiene permisos asignados.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
