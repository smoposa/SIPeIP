<!-- Permisos y accesos -->
<div class="mt-6 border-t border-gray-200 pt-4" data-permisos>
    <div class="flex items-center justify-between mb-2">
        <h3 class="text-lg font-semibold text-gray-800">
            Permisos y accesos
        </h3>

        <button type="button" class="text-sm text-blue-600 hover:text-blue-800"
            data-limpiar-permisos>
            Limpiar selección
        </button>
    </div>

    <p class="mb-4 text-sm text-gray-500">
        Marque los módulos a los que podrá acceder este rol y las acciones que podrá realizar.
    </p>

    @php
        $grupos = [
            'Inicio' => ['dashboard' => 'Inicio'],
            'Configuración' => ['roles' => 'Roles', 'usuarios' => 'Usuarios', 'entidades' => 'Entidades'],
            'Catálogos' => ['ods' => 'ODS', 'pnd' => 'PND', 'clasificacion_inversion' => 'Clasificación de la inversión'],
            'Planificación Institucional' => ['planes' => 'Planes', 'objetivos' => 'Objetivos', 'metas' => 'Metas', 'indicadores' => 'Indicadores'],
            'Inversión Pública' => ['programas' => 'Programas', 'proyectos' => 'Proyectos'],
            'Seguimiento' => ['avances' => 'Avances', 'presupuestos' => 'Presupuestos'],
            'Reportes' => ['reportes' => 'Reportes'],
            'Auditoría' => ['auditoria' => 'Auditoría'],
        ];

        $acciones = [
            'ver' => 'Acceder', 'crear' => 'Crear', 'editar' => 'Editar',
            'estado' => 'Cambiar estado', 'proceso' => 'Proceso', 'reabrir' => 'Reabrir',
            'editarRol' => 'Editar rol', 'editarEntidad' => 'Editar entidad',
            'editarPassword' => 'Editar contraseña',
        ];

        $seleccionados = array_map(
            'strval',
            (array) old('permisos', $permisosSeleccionados ?? [])
        );
    @endphp

    <p class="mb-3 text-xs text-gray-500" data-total-permisos aria-live="polite"></p>

    @foreach ($grupos as $grupo => $modulos)
        <details class="border-b border-gray-200" data-grupo-permisos>
            <summary class="cursor-pointer flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50" style="list-style: none;">
                <i class="bi bi-chevron-down text-blue-500 text-xs" data-flecha-permisos aria-hidden="true"></i>
                <span>{{ $grupo }}</span>
                <span class="ml-auto text-xs font-normal text-gray-500">
                    <span data-conteo-permisos></span>
                </span>
            </summary>

            <div class="ml-8 mb-3 border-l-2 border-gray-200 pl-3">
                @foreach ($modulos as $modulo => $nombre)
                    <div class="border-b border-gray-100 px-2 py-3">

                        <!-- Nombre del submódulo -->
                        <h4 class="mb-2 text-sm font-medium text-gray-700">
                            {{ $nombre }}
                        </h4>

                        <!-- Acciones del submódulo -->
                        <div class="grid grid-cols-2 gap-x-4 gap-y-2">

                            @foreach ($acciones as $accion => $etiqueta)
                                @php
                                    $permiso = $permisos->first(fn ($item) => $item->modulo === $modulo && $item->accion === $accion);
                                @endphp

                                @if ($permiso)
                                    <label class="flex items-center gap-2 text-xs text-gray-700">
                                        <input
                                            type="checkbox"
                                            name="permisos[]"
                                            value="{{ $permiso->id }}"
                                            @checked(in_array((string) $permiso->id, $seleccionados, true))
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        {{ $etiqueta }}
                                    </label>
                                @endif
                            @endforeach

                        </div>

                    </div>
                @endforeach
            </div>
        </details>
    @endforeach
</div>

<script>
    (() => {
        const seccion = document.currentScript.previousElementSibling;
        const grupos = seccion.querySelectorAll('[data-grupo-permisos]');

        // Actualizar los contadores sin modificar la selección.
        function actualizarConteos() {
            grupos.forEach(grupo => {
                const total = grupo.querySelectorAll('input[type="checkbox"]').length;
                const seleccionados = grupo.querySelectorAll('input[type="checkbox"]:checked').length;
                grupo.querySelector('[data-conteo-permisos]').textContent = `${seleccionados} de ${total} seleccionados`;
            });

            const total = seccion.querySelectorAll('input[type="checkbox"]').length;
            const seleccionados = seccion.querySelectorAll('input[type="checkbox"]:checked').length;
            seccion.querySelector('[data-total-permisos]').textContent = `${seleccionados} de ${total} permisos seleccionados`;
        }

        // Mantener abierta una sola categoría.
        grupos.forEach(grupo => {
            grupo.addEventListener('toggle', () => {
                const flecha = grupo.querySelector('[data-flecha-permisos]');
                flecha.classList.toggle('bi-chevron-up', grupo.open);
                flecha.classList.toggle('bi-chevron-down', !grupo.open);
                if (grupo.open) {
                    grupos.forEach(otro => {
                        if (otro !== grupo) otro.open = false;
                    });
                }
            });
        });

        seccion.addEventListener('change', actualizarConteos);
        seccion.querySelector('[data-limpiar-permisos]').addEventListener('click', () => {
            seccion.querySelectorAll('input[type="checkbox"]').forEach(casilla => {
                casilla.checked = false;
            });
            actualizarConteos();
            seccion.dispatchEvent(new Event('change', { bubbles: true }));
        });

        actualizarConteos();
    })();
</script>
