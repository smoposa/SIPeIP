<x-catalogos-layout :title="'Ejes  ' . $pnd->nombre">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs">

                <li>

                    <a href="{{ route('pnd.index') }}"
                       class="text-blue-600 hover:text-blue-800 hover:underline">

                        Planes nacionales

                    </a>

                </li>


                <li aria-hidden="true">
                    <i class="bi bi-chevron-right"></i>
                </li>


                <li class="break-words">
                    {{ $pnd->nombre }}
                </li>


                <li aria-hidden="true">
                    <i class="bi bi-chevron-right"></i>
                </li>


                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Ejes

                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('pnd.partials.avisos')


        <!-- Barra de acciones -->
        <div class="bg-white border-b border-gray-300 mb-0">

            <div class="flex">

                <a href="{{ route('pnd.index') }}"
                   class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                    <i class="bi bi-chevron-left" aria-hidden="true"></i>
                    Regresar

                </a>


                <a href="{{ url()->current() }}"
                   class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                    <i class="bi bi-arrow-clockwise text-blue-500 me-2" aria-hidden="true"></i>
                    Actualizar

                </a>

            </div>

        </div>


        <!-- Encabezado -->
        <p class="text-sm text-gray-500">
            Consulte y administre los ejes registrados en {{ $pnd->nombre }}.
        </p>


        <!-- Buscador, filtro, resumen y acciones -->
        <div class="flex flex-wrap items-center gap-4 mb-4">

            <!-- Buscador -->
            <div class="relative flex-1 max-w-md">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">

                    <i class="bi bi-search" aria-hidden="true"></i>

                </span>

                <input
                    type="text"
                    id="buscarEjePnd"
                    placeholder="Buscar eje..."
                    aria-label="Buscar eje"
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Estado -->
            <select
                id="filtroEstadoEjePnd"
                aria-label="Filtrar ejes por estado"
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
                        {{ $pnd->ejes->count() }}
                    </span>
                    registros ·

                    <span class="text-green-600 font-medium">
                        {{ $pnd->ejes->where('estado', 'Activo')->count() }}
                    </span>
                    activos ·

                    <span class="text-red-600 font-medium">
                        {{ $pnd->ejes->where('estado', 'Inactivo')->count() }}
                    </span>
                    inactivos

                </p>

            </div>


            <!-- Registrar -->
            @if(puedeHacer('pnd', 'crear'))

                <button
                    type="button"
                    id="registrarEjePnd"
                    aria-haspopup="dialog"
                    aria-controls="panelEjePnd"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-medium px-4 py-2 rounded-md
                           transition whitespace-nowrap">

                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Registrar eje

                </button>

            @endif

        </div>


        <!-- Listado y panel lateral -->
        <div id="gestionEjesPnd">

            @include('pnd.ejes.partials.listado-ejes')

            @include('pnd.ejes.partials.panel-editar-eje')

        </div>


        <!-- Funcionamiento -->
        @include('pnd.ejes.partials.scripts-ejes')

    </div>

</x-catalogos-layout>