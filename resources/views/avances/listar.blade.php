<x-seguimiento-layout title="Avances físicos">

    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex items-center text-xs">

                <li aria-current="page"
                    class="font-medium text-gray-700">
                    Avances físicos
                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('avances.partials.avisos')


        <!-- Encabezado -->
        <div class="mb-4">

            <p class="mt-1 text-sm text-gray-500">
                Consulte y registre el cumplimiento físico de los proyectos
                por indicador y período.
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
                    id="buscarAvance"
                    placeholder="Buscar avance físico..."
                    aria-label="Buscar por proyecto, indicador, año o período"
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Filtro -->
            <select
                id="filtroEstadoAvance"
                aria-label="Filtrar avances por estado"
                class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm
                       text-gray-700 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Todos los estados</option>
                <option value="Borrador">Borrador</option>
                <option value="Cerrado">Cerrado</option>

            </select>


            <!-- Resumen -->
            <div class="flex-1">

                <p class="text-sm text-gray-500">

                    <span class="font-medium text-blue-600">
                        {{ $avances->total() }}
                    </span>
                    registros ·

                    <span class="font-medium text-gray-600">
                        {{ $avances->getCollection()->where('estado', 'Borrador')->count() }}
                    </span>
                    borradores ·

                    <span class="font-medium text-green-600">
                        {{ $avances->getCollection()->where('estado', 'Cerrado')->count() }}
                    </span>
                    cerrados

                </p>

                @if($avances->hasPages())

                    <p class="mt-1 text-xs text-gray-500">
                        El buscador, el filtro y los conteos por estado
                        corresponden a esta página.
                    </p>

                @endif

            </div>


            <!-- Registrar -->
            @if(puedeHacer('avances', 'crear'))

                <a href="{{ route('avances.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-medium px-4 py-2 rounded-md
                          transition whitespace-nowrap">

                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Registrar avance

                </a>

            @endif

        </div>


        <!-- Listado -->
        <div id="gestionAvances">
            @include('avances.partials.listado-avances')
        </div>


        <!-- Paginación -->
        @if($avances->hasPages())

            <div class="mt-4">
                {{ $avances->links() }}
            </div>

        @endif


        @include('avances.partials.scripts-avances')

    </div>

</x-seguimiento-layout>