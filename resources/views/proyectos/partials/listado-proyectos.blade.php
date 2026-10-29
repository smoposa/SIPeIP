<!-- Listado de proyectos de inversión pública -->
<div class="border border-gray-200 rounded-lg overflow-hidden bg-white">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 290px);">

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
                        Proyecto de inversión
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Clasificación
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-right text-sm font-semibold text-gray-700">
                        Presupuesto
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

                @forelse($proyectos as $proyecto)

                    <tr
                        class="fila-proyecto border-b border-gray-100
                               hover:bg-gray-50 transition"
                        data-codigo="{{ $proyecto->codigo }}"
                        data-nombre="{{ $proyecto->nombre }}"
                        data-programa="{{ $proyecto->programa?->codigo }} {{ $proyecto->programa?->nombre }}"
                        data-responsable="{{ $proyecto->responsable?->nombres }} {{ $proyecto->responsable?->apellidos }}"
                        data-clasificacion="{{ $proyecto->subsector?->codigo }} {{ $proyecto->subsector?->nombre }} {{ $proyecto->subsector?->sector?->nombre }} {{ $proyecto->subsector?->sector?->macrosector?->nombre }}"
                        data-estado="{{ $proyecto->estado_administrativo }}"
                    >

                        <!-- Número -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">

                            {{ $proyectos->firstItem() + $loop->index }}

                        </td>


                        <!-- Proyecto y datos relacionados -->
                        <td class="px-2 py-2 text-xs max-w-md">

                            <a href="{{ route('proyectos.detalle', $proyecto->id) }}"
                               title="Ver detalle de {{ $proyecto->nombre }}"
                               class="font-medium text-blue-600 hover:text-blue-800
                                      hover:underline">

                                <span class="block line-clamp-2 break-words">
                                    {{ $proyecto->codigo }} - {{ $proyecto->nombre }}
                                </span>

                            </a>


                            <!-- Programa -->
                            <div class="mt-1 break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Programa:
                                </span>

                                <span class="text-gray-500">

                                    {{ $proyecto->programa?->codigo ?? 'No registra' }}

                                    @if($proyecto->programa?->nombre)
                                        - {{ $proyecto->programa->nombre }}
                                    @endif

                                </span>

                            </div>


                            <!-- Responsable -->
                            <div class="break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Responsable:
                                </span>

                                <span class="text-gray-500">

                                    {{ trim(
                                        ($proyecto->responsable?->nombres ?? '') . ' ' .
                                        ($proyecto->responsable?->apellidos ?? '')
                                    ) ?: 'No registra' }}

                                </span>

                            </div>


                            <!-- Ejecución -->
                            <div class="break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Ejecución:
                                </span>

                                <span class="text-gray-500">
                                    {{ $proyecto->estado }}
                                </span>

                            </div>

                        </td>


                        <!-- Clasificación -->
                        <td class="px-2 py-2 text-xs max-w-xs">

                            <p class="break-words font-medium text-gray-600">

                                {{ $proyecto->subsector?->codigo ?? 'Sin código' }}
                                -
                                {{ $proyecto->subsector?->nombre ?? 'Sin subsector' }}

                            </p>

                            <p class="mt-1 break-words text-gray-500">
                                {{ $proyecto->subsector?->sector?->nombre ?? 'Sin sector' }}
                            </p>

                            <p class="break-words text-gray-500">
                                {{ $proyecto->subsector?->sector?->macrosector?->nombre ?? 'Sin macrosector' }}
                            </p>

                        </td>


                        <!-- Presupuesto -->
                        <td class="px-2 py-2 text-right text-xs text-gray-600 whitespace-nowrap">

                            USD {{ number_format(
                                (float) $proyecto->presupuesto_aprobado,
                                2
                            ) }}

                        </td>


                        <!-- Estado del proceso -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @php
                                $claseProceso = match($proyecto->estado_proceso) {
                                    'Priorizado' => 'bg-green-100 text-green-700',
                                    'Observado' => 'bg-yellow-100 text-yellow-700',
                                    'Negado' => 'bg-red-100 text-red-700',
                                    'En revisión' => 'bg-blue-100 text-blue-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <span class="inline-flex rounded-full px-3 py-1 text-xs {{ $claseProceso }}">

                                {{ $proyecto->estado_proceso ?: 'Sin estado' }}

                            </span>

                        </td>


                        <!-- Estado administrativo -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($proyecto->estado_administrativo === 'Activo')

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

                            No existen proyectos registrados para su entidad.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosProyecto" class="hidden">

                    <td colspan="7"
                        class="px-4 py-6 text-center text-sm text-gray-500"
                        role="status"
                        aria-live="polite">

                        No se encontraron proyectos con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>