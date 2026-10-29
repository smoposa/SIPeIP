<!-- Listado de planes institucionales -->
<div class="border border-gray-200 rounded-lg overflow-hidden bg-white">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 260px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th scope="col"
                        class="px-4 py-2 text-center text-sm font-semibold text-gray-700">
                        Nro.
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Código
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Plan institucional
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Período
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Versión
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Proceso
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($planes as $plan)

                    <tr
                        class="fila-plan-institucional border-b border-gray-100
                               hover:bg-gray-50 transition"
                        data-codigo="{{ $plan->codigo }}"
                        data-nombre="{{ $plan->nombre }}"
                        data-entidad="{{ $plan->entidad?->nombre ?? '' }}"
                        data-periodo="{{ $plan->periodo_inicio }}-{{ $plan->periodo_fin }}"
                        data-estado="{{ $plan->estado }}"
                    >

                        <!-- Número -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">

                            {{ $planes->firstItem() + $loop->index }}

                        </td>


                        <!-- Código -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">

                            {{ $plan->codigo }}

                        </td>


                        <!-- Nombre y entidad -->
                        <td class="px-2 py-2 text-xs max-w-md">

                            <a href="{{ route('planes.detalle', $plan->id) }}"
                               title="Ver detalle de {{ $plan->nombre }}"
                               class="font-medium text-blue-600 hover:text-blue-800
                                      hover:underline">

                                <span class="block line-clamp-2 break-words">
                                    {{ $plan->nombre }}
                                </span>

                            </a>

                            <span class="mt-1 block break-words text-xs text-gray-500">
                                {{ $plan->entidad?->nombre ?? 'No registra entidad' }}
                            </span>

                        </td>


                        <!-- Período -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600 whitespace-nowrap">

                            {{ $plan->periodo_inicio }}–{{ $plan->periodo_fin }}

                        </td>


                        <!-- Versión -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600 whitespace-nowrap">

                            v{{ $plan->version }}

                        </td>


                        <!-- Estado del proceso -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @switch($plan->estado_proceso)

                                @case('Borrador')

                                    <span class="inline-flex rounded-full bg-gray-100
                                                 px-3 py-1 text-xs text-gray-700">
                                        Borrador
                                    </span>

                                    @break

                                @case('En revisión')

                                    <span class="inline-flex rounded-full bg-yellow-100
                                                 px-3 py-1 text-xs text-yellow-700">
                                        En revisión
                                    </span>

                                    @break

                                @case('Observado')

                                    <span class="inline-flex rounded-full bg-orange-100
                                                 px-3 py-1 text-xs text-orange-700">
                                        Observado
                                    </span>

                                    @break

                                @case('Aprobado')

                                    <span class="inline-flex rounded-full bg-blue-100
                                                 px-3 py-1 text-xs text-blue-700">
                                        Aprobado
                                    </span>

                                    @break

                                @default

                                    <span class="inline-flex rounded-full bg-gray-100
                                                 px-3 py-1 text-xs text-gray-600">
                                        Sin estado
                                    </span>

                            @endswitch

                        </td>


                        <!-- Estado administrativo -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($plan->estado === 'Activo')

                                <span class="inline-flex items-center gap-1.5 text-xs text-green-600">

                                    <i class="bi bi-check-lg font-bold" aria-hidden="true"></i>
                                    Activo

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 text-xs text-red-600">

                                    <i class="bi bi-x-lg font-bold" aria-hidden="true"></i>
                                    Inactivo

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen planes institucionales registrados.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosPlanInstitucional" class="hidden">

                    <td colspan="7"
                        class="px-4 py-6 text-center text-sm text-gray-500"
                        role="status"
                        aria-live="polite">

                        No se encontraron planes con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>