<x-proyectos-layout title="Proyectos de inversión pública">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex items-center text-xs">

                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Proyectos de inversión pública

                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('proyectos.partials.avisos')


        <!-- Encabezado -->
        <div class="mb-4">

            <p class="mt-1 text-sm text-gray-500">
                Consulte y administre el registro, la clasificación y la
                priorización de los proyectos de inversión de su entidad.
            </p>

        </div>


        <!-- Buscador, filtro, resumen y acciones -->
        <div class="flex flex-wrap items-center gap-4 mb-4">

            <!-- Buscador -->
            <div class="relative flex-1 max-w-md">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">

                    <i class="bi bi-search" aria-hidden="true"></i>

                </span>

                <input
                    type="search"
                    id="buscarProyecto"
                    placeholder="Buscar proyecto de inversión..."
                    aria-label="Buscar proyecto por código, nombre, programa, responsable o clasificación"
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Filtro de estado administrativo -->
            <select
                id="filtroEstadoProyecto"
                aria-label="Filtrar proyectos por estado administrativo"
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
                        {{ $proyectos->total() }}
                    </span>
                    registros ·

                    <span class="text-green-600 font-medium">
                        {{ $proyectos->getCollection()->where('estado_administrativo', 'Activo')->count() }}
                    </span>
                    activos ·

                    <span class="text-red-600 font-medium">
                        {{ $proyectos->getCollection()->where('estado_administrativo', 'Inactivo')->count() }}
                    </span>
                    inactivos

                </p>

                @if($proyectos->hasPages())

                    <p class="mt-1 text-xs text-gray-500">
                        El buscador, el filtro y los conteos por estado
                        corresponden a esta página.
                    </p>

                @endif

            </div>


            <!-- Registrar proyecto -->
            @if(puedeHacer('proyectos', 'crear'))

                <a href="{{ route('proyectos.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-medium px-4 py-2 rounded-md
                          transition whitespace-nowrap">

                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Registrar proyecto

                </a>

            @endif

        </div>


        <!-- Presupuesto registrado -->
        <p class="text-sm text-gray-500">

            Presupuesto registrado:

            <span class="font-medium text-blue-600">
                USD {{ number_format((float) $presupuestoTotal, 2) }}
            </span>

        </p>


        <!-- Listado -->
        <div id="gestionProyectos">

            @include('proyectos.partials.listado-proyectos')

        </div>


        <!-- Paginación -->
        @if($proyectos->hasPages())

            <div class="mt-4">

                {{ $proyectos->links() }}

            </div>

        @endif


        <!-- Funcionamiento de la pantalla -->
        @include('proyectos.partials.scripts-proyectos')

    </div>

</x-proyectos-layout>