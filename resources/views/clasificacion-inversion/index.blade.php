<x-catalogos-layout title="Clasificación de la inversión">

    <div class="space-y-5">

        <!-- =========================================================
             ENCABEZADO
        ========================================================== -->
        <div class="rounded-lg border border-gray-200 bg-white">

            <div class="flex flex-col gap-4 px-5 py-4
                        lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center
                                justify-center rounded-lg border border-gray-200
                                bg-gray-100">

                        <i class="bi bi-diagram-3 text-xl text-gray-600"></i>

                    </div>

                    <div>

                        <p class="text-xs font-medium uppercase
                                  tracking-wide text-gray-400">
                            Catálogo institucional
                        </p>

                        <h3 class="text-lg font-semibold text-gray-800">
                            Sectores y subsectores de intervención
                        </h3>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Clasificación oficial utilizada para los
                            programas y proyectos de inversión pública.
                        </p>

                    </div>

                </div>

                <div class="flex items-center">

                    <span class="inline-flex items-center gap-2 rounded-full
                                 border border-green-200 bg-green-50
                                 px-3 py-1.5 text-xs font-medium
                                 text-green-700">

                        <span class="h-2 w-2 rounded-full bg-green-500"></span>

                        Catálogo cargado

                    </span>

                </div>

            </div>

        </div>


        <!-- =========================================================
             RESUMEN
        ========================================================== -->
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">

            <!-- Macrosectores -->
            <div class="rounded-lg border border-gray-200 bg-white px-4 py-3">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 flex-shrink-0 items-center
                                justify-center rounded-lg bg-slate-100">

                        <i class="bi bi-grid-1x2 text-slate-600"></i>

                    </div>

                    <div>

                        <p class="text-xl font-semibold text-gray-800">
                            {{ $totalMacrosectores }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Macrosectores
                        </p>

                    </div>

                </div>

            </div>


            <!-- Sectores -->
            <div class="rounded-lg border border-gray-200 bg-white px-4 py-3">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 flex-shrink-0 items-center
                                justify-center rounded-lg bg-slate-100">

                        <i class="bi bi-diagram-2 text-slate-600"></i>

                    </div>

                    <div>

                        <p class="text-xl font-semibold text-gray-800">
                            {{ $totalSectores }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Sectores
                        </p>

                    </div>

                </div>

            </div>


            <!-- Subsectores -->
            <div class="rounded-lg border border-gray-200 bg-white px-4 py-3">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 flex-shrink-0 items-center
                                justify-center rounded-lg bg-slate-100">

                        <i class="bi bi-list-nested text-slate-600"></i>

                    </div>

                    <div>

                        <p class="text-xl font-semibold text-gray-800">
                            {{ $totalSubsectores }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Subsectores
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================================================
             TÍTULO DE LA ESTRUCTURA
        ========================================================== -->
        <div class="flex items-center justify-between">

            <div>

                <h3 class="text-base font-semibold text-gray-800">
                    Estructura de intervención
                </h3>

                <p class="mt-0.5 text-xs text-gray-500">
                    Macrosector, sector y subsector con su código oficial.
                </p>

            </div>

        </div>


        <!-- =========================================================
             LISTADO JERÁRQUICO
        ========================================================== -->
        <div
            class="overflow-y-auto pr-1"
            style="height: calc(100vh - 390px); min-height: 300px;"
        >

            @forelse($macrosectores as $macrosector)

                @php
                    $totalSubsectoresMacrosector = $macrosector
                        ->sectores
                        ->sum(
                            fn ($sector) => $sector
                                ->subsectores
                                ->count()
                        );
                @endphp

                <details
                    class="mb-3 overflow-hidden rounded-lg
                           border border-gray-200 bg-white"
                >

                    <!-- Macrosector -->
                    <summary
                        class="flex cursor-pointer list-none items-center
                               justify-between bg-gray-50 px-4 py-3
                               transition hover:bg-gray-100"
                    >

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-9 w-9 flex-shrink-0
                                        items-center justify-center
                                        rounded-lg border border-gray-200
                                        bg-white">

                                <i class="bi bi-grid-1x2 text-gray-600"></i>

                            </div>

                            <div class="min-w-0">

                                <div class="flex flex-wrap items-center gap-2">

                                    <h4 class="text-sm font-semibold text-gray-800">
                                        {{ $macrosector->nombre }}
                                    </h4>

                                    @if($macrosector->estado === 'Activo')

                                        <span class="inline-flex items-center
                                                     rounded-full bg-green-50
                                                     px-2 py-0.5 text-[11px]
                                                     font-medium text-green-700">
                                            Activo
                                        </span>

                                    @else

                                        <span class="inline-flex items-center
                                                     rounded-full bg-red-50
                                                     px-2 py-0.5 text-[11px]
                                                     font-medium text-red-700">
                                            Inactivo
                                        </span>

                                    @endif

                                </div>

                                <p class="mt-0.5 text-xs text-gray-500">
                                    {{ $macrosector->sectores->count() }}
                                    sectores ·
                                    {{ $totalSubsectoresMacrosector }}
                                    subsectores
                                </p>

                            </div>

                        </div>

                        <i class="bi bi-chevron-down ml-4 text-sm text-gray-500"></i>

                    </summary>


                    <!-- Sectores -->
                    <div class="space-y-3 border-t border-gray-200 p-3">

                        @forelse($macrosector->sectores as $sector)

                            <div class="overflow-hidden rounded-md
                                        border border-gray-200">

                                <!-- Encabezado del sector -->
                                <div class="flex items-center justify-between
                                            bg-white px-4 py-2.5">

                                    <div class="flex items-center gap-2">

                                        <i class="bi bi-diagram-2 text-gray-400"></i>

                                        <span class="text-sm font-medium text-gray-700">
                                            {{ $sector->nombre }}
                                        </span>

                                        @if($sector->estado === 'Activo')

                                            <span class="rounded-full bg-green-50
                                                         px-2 py-0.5 text-[10px]
                                                         font-medium text-green-700">
                                                Activo
                                            </span>

                                        @else

                                            <span class="rounded-full bg-red-50
                                                         px-2 py-0.5 text-[10px]
                                                         font-medium text-red-700">
                                                Inactivo
                                            </span>

                                        @endif

                                    </div>

                                    <span class="text-xs text-gray-400">
                                        {{ $sector->subsectores->count() }}
                                        subsectores
                                    </span>

                                </div>


                                <!-- Tabla de subsectores -->
                                <div class="overflow-x-auto border-t
                                            border-gray-200">

                                    <table class="min-w-full divide-y
                                                  divide-gray-200">

                                        <thead class="bg-gray-50">

                                            <tr>

                                                <th class="w-32 px-4 py-2
                                                           text-left text-xs
                                                           font-medium uppercase
                                                           tracking-wide
                                                           text-gray-500">
                                                    Código
                                                </th>

                                                <th class="px-4 py-2 text-left
                                                           text-xs font-medium
                                                           uppercase tracking-wide
                                                           text-gray-500">
                                                    Subsector
                                                </th>

                                                <th class="w-40 px-4 py-2
                                                           text-left text-xs
                                                           font-medium uppercase
                                                           tracking-wide
                                                           text-gray-500">
                                                    Nivel
                                                </th>

                                                <th class="w-28 px-4 py-2
                                                           text-center text-xs
                                                           font-medium uppercase
                                                           tracking-wide
                                                           text-gray-500">
                                                    Estado
                                                </th>

                                            </tr>

                                        </thead>

                                        <tbody class="divide-y divide-gray-100
                                                      bg-white">

                                            @forelse($sector->subsectores as $subsector)

                                                <tr class="hover:bg-gray-50">

                                                    <td class="whitespace-nowrap
                                                               px-4 py-2.5">

                                                        <span class="font-mono
                                                                     text-xs
                                                                     font-semibold
                                                                     text-[#024687]">
                                                            {{ $subsector->codigo }}
                                                        </span>

                                                    </td>

                                                    <td class="px-4 py-2.5
                                                               text-sm text-gray-700">
                                                        {{ $subsector->nombre }}
                                                    </td>

                                                    <td class="whitespace-nowrap
                                                               px-4 py-2.5
                                                               text-xs text-gray-500">
                                                        {{ $subsector->nivel_gobierno }}
                                                    </td>

                                                    <td class="whitespace-nowrap
                                                               px-4 py-2.5
                                                               text-center">

                                                        @if($subsector->estado === 'Activo')

                                                            <span class="inline-flex
                                                                         items-center
                                                                         gap-1.5
                                                                         rounded-full
                                                                         bg-green-50
                                                                         px-2 py-1
                                                                         text-[11px]
                                                                         font-medium
                                                                         text-green-700">

                                                                <span class="h-1.5
                                                                             w-1.5
                                                                             rounded-full
                                                                             bg-green-500">
                                                                </span>

                                                                Activo

                                                            </span>

                                                        @else

                                                            <span class="inline-flex
                                                                         items-center
                                                                         gap-1.5
                                                                         rounded-full
                                                                         bg-red-50
                                                                         px-2 py-1
                                                                         text-[11px]
                                                                         font-medium
                                                                         text-red-700">

                                                                <span class="h-1.5
                                                                             w-1.5
                                                                             rounded-full
                                                                             bg-red-500">
                                                                </span>

                                                                Inactivo

                                                            </span>

                                                        @endif

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td
                                                        colspan="4"
                                                        class="px-4 py-4
                                                               text-center text-sm
                                                               text-gray-500"
                                                    >
                                                        No existen subsectores registrados.
                                                    </td>

                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        @empty

                            <div class="rounded-md border border-dashed
                                        border-gray-300 px-4 py-6 text-center">

                                <p class="text-sm text-gray-500">
                                    Este macrosector no tiene sectores registrados.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </details>

            @empty

                <div class="rounded-lg border border-dashed border-gray-300
                            bg-white px-6 py-12 text-center">

                    <i class="bi bi-inbox text-3xl text-gray-300"></i>

                    <p class="mt-3 text-sm font-medium text-gray-600">
                        No existen clasificaciones registradas.
                    </p>

                    <p class="mt-1 text-xs text-gray-400">
                        Registre un macrosector para comenzar.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</x-catalogos-layout>