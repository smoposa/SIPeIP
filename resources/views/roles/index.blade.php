<x-roles-layout title="Todos los roles">

    <div class="space-y-5">

        {{-- =========================================================
             ENCABEZADO
        ========================================================== --}}
        <div>
        

            <p class="mt-1 text-sm text-gray-600">
                Administre los roles y niveles de acceso del Sistema Integral
                de Planificación e Inversión Pública (SIPeIP).
            </p>
        </div>




        {{-- =========================================================
             RESUMEN
        ========================================================== --}}
        <div class="flex flex-wrap items-center gap-x-8 gap-y-2 text-sm">

            <div>
                <span class="font-semibold text-gray-900">
                    {{ $totalRoles }}
                </span>
                <span class="text-gray-500">
                    Roles registrados
                </span>
            </div>

            <div>
                <span class="font-semibold text-gray-900">
                    {{ $rolesActivos }}
                </span>
                <span class="text-gray-500">
                    Activos
                </span>
            </div>

            <div>
                <span class="font-semibold text-gray-900">
                    {{ $rolesInactivos }}
                </span>
                <span class="text-gray-500">
                    Inactivos
                </span>
            </div>

        </div>


        {{-- =========================================================
            BUSCADOR, FILTRO Y ACCIONES
        ========================================================== --}}
        <div class="flex flex-col lg:flex-row lg:items-center gap-3">

            {{-- Buscador --}}
            <div class="relative w-full lg:max-w-md">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3
                            text-gray-400">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="text"
                    id="buscarRol"
                    placeholder="Buscar por nombre o descripción"
                    class="w-full rounded-md border border-gray-300
                        py-2 pl-10 pr-3 text-sm
                        focus:border-blue-500 focus:ring-blue-500"
                >

            </div>

            {{-- Filtro de estado --}}
            <select
                id="filtroEstado"
                    class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm
                    text-gray-700 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Todos los estados</option>
                <option value="Activo">Activos</option>
                <option value="Inactivo">Inactivos</option>

            </select>


            {{-- Acción: Crear rol --}}
            <div class="flex items-center lg:ml-auto">

                @if(puedeHacer('roles', 'crear'))
                    <a href="{{ route('roles.create') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">

                        <i class="bi bi-plus-lg"></i>

                        Crear rol

                    </a>
                @endif

            </div>

        </div>


    {{-- =========================================================
        TABLA DE ROLES
    ========================================================== --}}
    <div class="flex flex-col min-h-0 border-t border-gray-200"
        style="height: calc(100vh - 260px);">

        <div class="overflow-auto min-h-0 flex-1">

            <table class="min-w-full text-sm">

                {{-- Encabezado fijo --}}
                <thead class="sticky top-0 z-10 bg-white">

                    <tr class="border-b border-gray-200 text-left text-gray-600">

                        <th class="px-4 py-3 font-semibold">
                            Rol
                        </th>

                        <th class="px-4 py-3 font-semibold">
                            Descripción
                        </th>

                        <th class="px-4 py-3 font-semibold text-center whitespace-nowrap">
                            Usuarios asignados
                        </th>

                        <th class="px-4 py-3 font-semibold">
                            Estado
                        </th>

                    </tr>

                </thead>

                <tbody id="tablaRoles">

                    @forelse($roles as $rol)

                        <tr
                            class="fila-rol border-b border-gray-100 hover:bg-gray-50 transition"
                            data-nombre="{{ strtolower($rol->nombre) }}"
                            data-descripcion="{{ strtolower($rol->descripcion) }}"
                            data-estado="{{ $rol->estado }}"
                        >

                            <td class="px-4 py-3">

                                <a href="{{ route('roles.detalle', $rol->id) }}"
                                class="font-xs text-blue-700 hover:underline">

                                    {{ $rol->nombre }}

                                </a>

                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $rol->descripcion }}
                            </td>

                            <td class="px-4 py-3 text-center">

                                <span class="font-xs text-gray-800">
                                    {{ $rol->users_count }}
                                </span>

                            </td>

                            <td class="px-4 py-3">

                                @if($rol->estado === 'Activo')

                                    <span class="inline-flex items-center rounded
                                                border border-green-600
                                                px-2 py-0.5 text-xs font-xs
                                                text-green-700">
                                        Activo
                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded
                                                border border-gray-400
                                                px-2 py-0.5 text-xs font-xs
                                                text-gray-600">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="px-4 py-10 text-center text-gray-500">

                                No existen roles registrados.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


        {{-- Mensaje cuando el buscador no encuentra resultados --}}
        <div id="sinResultados"
             class="hidden py-8 text-center text-sm text-gray-500">

            No se encontraron roles que coincidan con la búsqueda.

        </div>

    </div>


    {{-- =============================================================
         BÚSQUEDA Y FILTRO LOCAL
    ============================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const buscador = document.getElementById('buscarRol');
            const filtroEstado = document.getElementById('filtroEstado');
            const filas = document.querySelectorAll('.fila-rol');
            const sinResultados = document.getElementById('sinResultados');

            function filtrarRoles() {

                const texto = buscador.value.toLowerCase().trim();
                const estado = filtroEstado.value;

                let visibles = 0;

                filas.forEach(function (fila) {

                    const nombre = fila.dataset.nombre;
                    const descripcion = fila.dataset.descripcion;
                    const estadoRol = fila.dataset.estado;

                    const coincideTexto =
                        nombre.includes(texto) ||
                        descripcion.includes(texto);

                    const coincideEstado =
                        estado === '' ||
                        estadoRol === estado;

                    const mostrar =
                        coincideTexto && coincideEstado;

                    fila.style.display = mostrar ? '' : 'none';

                    if (mostrar) {
                        visibles++;
                    }

                });

                sinResultados.classList.toggle(
                    'hidden',
                    visibles !== 0
                );
            }

            buscador.addEventListener('input', filtrarRoles);
            filtroEstado.addEventListener('change', filtrarRoles);

        });
    </script>

</x-roles-layout>