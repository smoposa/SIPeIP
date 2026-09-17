<x-planes-layout title="Consultar Planes Institucionales">

    <!-- Mensaje de éxito -->
    @if(session('success'))

        <div id="alertSuccess"
             class="fixed right-5 top-5 z-50 rounded-lg
                    bg-green-600 px-6 py-3 text-white shadow-lg">

            {{ session('success') }}

        </div>

        <script>
            setTimeout(() => {
                const alerta = document.getElementById('alertSuccess');

                if (alerta) {
                    alerta.remove();
                }
            }, 3000);
        </script>

    @endif

    <!-- Encabezado -->
    <div class="mb-2">

        <h2 class="text-2xl font-semibold text-gray-800">
            Planes Institucionales
        </h2>

    </div>

    <!-- Resumen y acción -->
    <div class="mb-4 flex flex-wrap items-center justify-between gap-4">

        <p class="text-sm text-gray-500">

            <span class="font-medium text-gray-700">
                {{ $totalPlanes }}
            </span>

            registros ·

            <span class="font-medium text-green-600">
                {{ $planesActivos }}
            </span>

            activos ·

            <span class="font-medium text-red-600">
                {{ $planesInactivos }}
            </span>

            inactivos

        </p>

        @if(puedeHacer('planes', 'crear'))

            <a href="{{ route('planes.create') }}"
               class="inline-flex h-10 items-center gap-2 rounded-md
                      bg-blue-600 px-4 text-sm font-medium text-white
                      transition hover:bg-blue-700">

                <i class="bi bi-plus-lg"></i>

                Crear plan

            </a>

        @endif

    </div>

    <!-- Tabla -->
    <div class="min-w-0 w-full overflow-x-hidden overflow-y-auto"
         style="height: calc(100vh - 230px);">

        <div class="min-w-0 rounded-lg border border-gray-200 bg-white">

            <table class="w-full table-fixed">

                <thead class="sticky top-0 z-10 border-b
                              border-gray-200 bg-gray-50">

                    <tr>

                        <th class="w-14 px-2 py-2 text-left
                                   text-sm font-semibold text-gray-700">
                            Nro.
                        </th>

                        <th class="w-32 px-2 py-2 text-left
                                   text-sm font-semibold text-gray-700">
                            Código
                        </th>

                        <th class="px-2 py-2 text-left
                                   text-sm font-semibold text-gray-700">
                            Nombre
                        </th>

                        <th class="w-32 px-2 py-2 text-left
                                   text-sm font-semibold text-gray-700">
                            Período
                        </th>

                        <th class="w-20 px-2 py-2 text-center
                                   text-sm font-semibold text-gray-700">
                            Versión
                        </th>

                        <th class="w-32 px-2 py-2 text-center
                                   text-sm font-semibold text-gray-700">
                            Proceso
                        </th>

                        <th class="w-24 px-2 py-2 text-center
                                   text-sm font-semibold text-gray-700">
                            Estado
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($planes as $plan)

                        <tr class="hover:bg-gray-50">

                            <!-- Número -->
                            <td class="px-2 py-2 text-sm text-gray-600">

                                {{ $planes->firstItem() + $loop->index }}

                            </td>

                            <!-- Código -->
                            <td class="break-words px-2 py-2
                                       text-sm text-gray-700">

                                {{ $plan->codigo }}

                            </td>

                            <!-- Nombre -->
                            <td class="min-w-0 px-2 py-2">

                                <a href="{{ route('planes.detalle', $plan->id) }}"
                                   class="break-words text-sm font-medium
                                          text-blue-600 hover:text-blue-800
                                          hover:underline">

                                    {{ $plan->nombre }}

                                </a>

                                <span class="mt-1 block break-words text-xs text-gray-500">
                                    {{ $plan->entidad?->nombre ?? 'No registra entidad' }}
                                </span>

                            </td>

                            <!-- Período -->
                            <td class="px-2 py-2 text-sm text-gray-700">

                                {{ $plan->periodo_inicio }}
                                -
                                {{ $plan->periodo_fin }}

                            </td>

                            <!-- Versión -->
                            <td class="px-2 py-2 text-center text-sm text-gray-700">

                                v{{ $plan->version }}

                            </td>

                            <!-- Estado del proceso -->
                            <td class="px-2 py-2 text-center">

                                @switch($plan->estado_proceso)

                                    @case('Borrador')

                                        <span class="inline-flex whitespace-nowrap
                                                     rounded-full bg-gray-100 px-3 py-1
                                                     text-xs text-gray-700">
                                            Borrador
                                        </span>

                                        @break

                                    @case('En revisión')

                                        <span class="inline-flex whitespace-nowrap
                                                     rounded-full bg-yellow-100 px-3 py-1
                                                     text-xs text-yellow-700">
                                            En revisión
                                        </span>

                                        @break

                                    @case('Observado')

                                        <span class="inline-flex whitespace-nowrap
                                                     rounded-full bg-orange-100 px-3 py-1
                                                     text-xs text-orange-700">
                                            Observado
                                        </span>

                                        @break

                                    @case('Aprobado')

                                        <span class="inline-flex whitespace-nowrap
                                                     rounded-full bg-blue-100 px-3 py-1
                                                     text-xs text-blue-700">
                                            Aprobado
                                        </span>

                                        @break

                                    @default

                                        <span class="inline-flex whitespace-nowrap
                                                     rounded-full bg-gray-100 px-3 py-1
                                                     text-xs text-gray-600">
                                            Sin estado
                                        </span>

                                @endswitch

                            </td>

                            <!-- Estado administrativo -->
                            <td class="px-2 py-2 text-center">

                                @if($plan->estado === 'Activo')

                                    <span class="inline-flex whitespace-nowrap
                                                 rounded-full bg-green-100 px-3 py-1
                                                 text-xs text-green-700">
                                        Activo
                                    </span>

                                @else

                                    <span class="inline-flex whitespace-nowrap
                                                 rounded-full bg-red-100 px-3 py-1
                                                 text-xs text-red-700">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="px-6 py-10 text-center text-gray-500">

                                No existen planes institucionales registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Paginación -->
    @if($planes->hasPages())

        <div class="mt-4">
            {{ $planes->links() }}
        </div>

    @endif

</x-planes-layout>