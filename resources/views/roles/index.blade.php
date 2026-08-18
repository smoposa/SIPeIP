<x-roles-layout title="Todos los roles">

    <div class="space-y-5">
        
        <!-- Encabezado -->
        <div>
            <p class="mt-1 text-sm text-gray-600">
                Administre los roles y niveles de acceso del Sistema Integral
                de Planificación e Inversión Pública (SIPeIP).
            </p>
        </div>


        <!-- Buscador, filtro, resumen y acciones -->
        <div class="flex items-center gap-4 mb-4">

            <!-- Buscador -->
            <div class="relative flex-1 max-w-md">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="text"
                    id="buscarRol"
                    placeholder="Buscar rol..."
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                        focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Filtro Estado -->
            <select
                id="filtroEstado"
                class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm
                    text-gray-700 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Todos los estados</option>
                <option value="Activo">Activos</option>
                <option value="Inactivo">Inactivos</option>

            </select>


            <!-- Resumen de estados -->
            <div class="flex-1">

                <p class="text-sm text-gray-500">

                    {{ $totalRoles }} registros ·

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

                    <i class="bi bi-plus-lg"></i>

                    Crear rol

                </a>

            @endif

        </div>


        <!-- Listado de entidades -->
        @include('roles.partials.listado-roles')



        {{-- Mensaje cuando el buscador no encuentra resultados --}}
        <div id="sinResultados"
             class="hidden py-8 text-center text-sm text-gray-500">

            No se encontraron roles que coincidan con la búsqueda.

        </div>

    </div>

    <!-- Buscador y filtro -->
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