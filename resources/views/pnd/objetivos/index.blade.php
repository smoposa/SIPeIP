<x-catalogos-layout :title="'Objetivos  ' . $eje->nombre">

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


                <li>

                    <a href="{{ route('pnd.ejes.index', ['pnd' => $eje->pnd_id]) }}"
                       class="text-blue-600 hover:text-blue-800 hover:underline">

                        {{ $eje->pnd->nombre }}

                    </a>

                </li>


                <li aria-hidden="true">
                    <i class="bi bi-chevron-right"></i>
                </li>


                <li class="break-words">
                    Eje {{ $eje->numero }} · {{ $eje->nombre }}
                </li>


                <li aria-hidden="true">
                    <i class="bi bi-chevron-right"></i>
                </li>


                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Objetivos

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

                <a href="{{ route('pnd.ejes.index', ['pnd' => $eje->pnd_id]) }}"
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
            Consulte y administre los objetivos nacionales registrados
            en el eje {{ $eje->nombre }}.
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
                    id="buscarObjetivoPnd"
                    placeholder="Buscar objetivo..."
                    aria-label="Buscar objetivo"
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Filtro de estado -->
            <select
                id="filtroEstadoObjetivoPnd"
                aria-label="Filtrar objetivos por estado"
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
                        {{ $eje->objetivos->count() }}
                    </span>
                    registros ·

                    <span class="text-green-600 font-medium">
                        {{ $eje->objetivos->where('estado', 'Activo')->count() }}
                    </span>
                    activos ·

                    <span class="text-red-600 font-medium">
                        {{ $eje->objetivos->where('estado', 'Inactivo')->count() }}
                    </span>
                    inactivos

                </p>

            </div>


            <!-- Registrar objetivo -->
            @if(puedeHacer('pnd', 'crear'))

                <button
                    type="button"
                    id="registrarObjetivoPnd"
                    aria-haspopup="dialog"
                    aria-controls="panelObjetivoPnd"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-medium px-4 py-2 rounded-md
                           transition whitespace-nowrap">

                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Registrar objetivo

                </button>

            @endif

        </div>


        <!-- Listado y panel lateral -->
        <div id="gestionObjetivosPnd">

            @include('pnd.objetivos.partials.listado-objetivos')

            @include('pnd.objetivos.partials.panel-editar-objetivo')

        </div>


        <!-- Buscador, filtro y panel lateral -->
        @include('pnd.objetivos.partials.scripts-objetivos')

    </div>

</x-catalogos-layout>