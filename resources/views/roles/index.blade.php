<x-roles-layout title="Todos los roles">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex items-center text-xs">

                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Roles

                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <!-- Notificación de éxito -->
        @if(session('success'))

            <div id="alertSuccess"
                 role="status"
                 class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">

                {{ session('success') }}

            </div>

            <script>
                setTimeout(() => {
                    document.getElementById('alertSuccess')?.remove();
                }, 3000);
            </script>

        @endif


        <!-- Barra de navegación -->
        <div class="bg-white border-b border-gray-300 mb-4">

            <div class="flex flex-wrap">

                <!-- Roles -->
                <a href="{{ route('roles.index') }}"
                   aria-current="page"
                   class="px-3 py-2 text-sm font-medium text-gray-800
                          border-b-2 border-blue-500
                          hover:bg-gray-100 transition">

                    <i class="bi bi-person-check text-blue-500 me-2" aria-hidden="true"></i>
                    Roles

                </a>


                <!-- Asignación de roles -->
                <a href="{{ route('roles.asignacion') }}"
                   class="px-3 py-2 text-sm font-medium text-gray-800
                          border-b-2 border-transparent
                          hover:bg-gray-100 transition">

                    <i class="bi bi-list-check text-blue-500 me-2" aria-hidden="true"></i>
                    Asignación de Roles

                </a>


                <!-- Actualizar -->
                <a href="{{ url()->current() }}"
                   class="px-3 py-2 text-sm font-medium text-gray-700
                          border-b-2 border-transparent
                          hover:bg-gray-100 transition">

                    <i class="bi bi-arrow-clockwise text-blue-500 me-2" aria-hidden="true"></i>
                    Actualizar

                </a>

            </div>

        </div>


        <!-- Buscador, filtro, resumen y acciones -->
        <div class="flex flex-wrap items-center gap-4 mb-4">

            <!-- Buscador -->
            <div class="relative flex-1 max-w-md">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="bi bi-search" aria-hidden="true"></i>
                </span>

                <input
                    type="text"
                    id="buscarRol"
                    placeholder="Buscar rol..."
                    aria-label="Buscar rol"
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Filtro de estado -->
            <select
                id="filtroEstado"
                aria-label="Filtrar roles por estado"
                class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm
                       text-gray-700 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Todos los estados</option>
                <option value="Activo">Activos</option>
                <option value="Inactivo">Inactivos</option>

            </select>


            <!-- Resumen -->
            <div class="flex-1">

                <p class="text-sm text-gray-500">

                    <span class="text-blue-600 font-medium">
                        {{ $totalRoles }}
                    </span>
                    registros ·

                    <span class="text-green-600 font-medium">
                        {{ $rolesActivos }}
                    </span>
                    activos ·

                    <span class="text-red-600 font-medium">
                        {{ $rolesInactivos }}
                    </span>
                    inactivos

                </p>

            </div>


            <!-- Crear rol -->
            @if(puedeHacer('roles', 'crear'))

                <a href="{{ route('roles.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-medium px-4 py-2 rounded-md
                          transition whitespace-nowrap">

                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Crear rol

                </a>

            @endif

        </div>


        <!-- Listado -->
        @include('roles.partials.listado-roles')


        <!-- Buscador y filtro -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const buscador = document.getElementById('buscarRol');
                const filtroEstado = document.getElementById('filtroEstado');
                const filas = document.querySelectorAll('.fila-rol');

                function filtrarRoles() {

                    const texto = buscador.value.toLowerCase().trim();
                    const estado = filtroEstado.value;

                    filas.forEach(function (fila) {

                        const nombre = (fila.dataset.nombre || '').toLowerCase();
                        const descripcion = (fila.dataset.descripcion || '').toLowerCase();
                        const estadoRol = fila.dataset.estado || '';

                        const coincideTexto =
                            nombre.includes(texto) ||
                            descripcion.includes(texto);

                        const coincideEstado =
                            estado === '' || estadoRol === estado;

                        fila.style.display =
                            coincideTexto && coincideEstado ? '' : 'none';

                    });

                }

                buscador.addEventListener('input', filtrarRoles);
                filtroEstado.addEventListener('change', filtrarRoles);

            });
        </script>

    </div>

</x-roles-layout>