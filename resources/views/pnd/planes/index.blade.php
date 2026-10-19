<x-catalogos-layout title="Planes Nacionales de Desarrollo">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex items-center text-xs">

                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Planes nacionales

                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('pnd.partials.avisos')


        <!-- Encabezado -->
        <div class="mb-4">

            <p class="mt-1 text-sm text-gray-500">
                Consulte y administre los planes nacionales de desarrollo
                registrados en el sistema.
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
                    type="text"
                    id="buscarPlanPnd"
                    placeholder="Buscar plan nacional..."
                    aria-label="Buscar plan nacional"
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Filtro de estado -->
            <select
                id="filtroEstadoPnd"
                aria-label="Filtrar planes por estado"
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
                        {{ $planes->total() }}
                    </span>
                    registros ·

                    <span class="text-green-600 font-medium">
                        {{ $planes->getCollection()->where('estado', 'Activo')->count() }}
                    </span>
                    activos ·

                    <span class="text-red-600 font-medium">
                        {{ $planes->getCollection()->where('estado', 'Inactivo')->count() }}
                    </span>
                    inactivos

                </p>


                @if($planes->hasPages())

                    <p class="mt-1 text-xs text-gray-500">
                        El buscador, el filtro y los conteos por estado
                        corresponden a esta página.
                    </p>

                @endif

            </div>


            <!-- Registrar plan -->
            @if(puedeHacer('pnd', 'crear'))

                <button
                    type="button"
                    id="registrarPlanPnd"
                    aria-haspopup="dialog"
                    aria-controls="panelPlanPnd"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-medium px-4 py-2 rounded-md
                           transition whitespace-nowrap">

                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Registrar plan

                </button>

            @endif

        </div>


        <!-- Listado y panel -->
        <div id="gestionPlanesPnd">

            @include('pnd.planes.partials.listado-planes')

            @include('pnd.planes.partials.panel-editar-plan')

        </div>


        <!-- Paginación -->
        @if($planes->hasPages())

            <div class="mt-4">

                {{ $planes->links() }}

            </div>

        @endif


        <!-- Funcionamiento de la pantalla -->
        @include('pnd.planes.partials.scripts-planes')

    </div>

</x-catalogos-layout>