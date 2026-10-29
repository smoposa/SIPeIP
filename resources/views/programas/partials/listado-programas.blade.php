<!-- Listado de programas de inversión -->
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
                        Programa de inversión
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Período
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Proyectos
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

                @forelse($programas as $programa)

                    <tr
                        class="fila-programa border-b border-gray-100
                               hover:bg-gray-50 transition"
                        data-codigo="{{ $programa->codigo }}"
                        data-nombre="{{ $programa->nombre }}"
                        data-periodo="{{ $programa->periodo_inicio }}-{{ $programa->periodo_fin }}"
                        data-responsable="{{ $programa->responsable?->nombres }} {{ $programa->responsable?->apellidos }}"
                        data-estado="{{ $programa->estado }}"
                    >

                        <!-- Número -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">

                            {{ $programas->firstItem() + $loop->index }}

                        </td>


                        <!-- Código -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">

                            {{ $programa->codigo }}

                        </td>


                        <!-- Programa y datos relacionados -->
                        <td class="px-2 py-2 text-xs max-w-md">

                            <a href="{{ route('programas.detalle', $programa->id) }}"
                               title="Ver detalle de {{ $programa->nombre }}"
                               class="font-medium text-blue-600 hover:text-blue-800
                                      hover:underline">

                                <span class="block line-clamp-2 break-words">
                                    {{ $programa->nombre }}
                                </span>

                            </a>


                            <div class="mt-1 break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Responsable:
                                </span>

                                <span class="text-gray-500">

                                    {{ trim(
                                        ($programa->responsable?->nombres ?? '') . ' ' .
                                        ($programa->responsable?->apellidos ?? '')
                                    ) ?: 'No registra' }}

                                </span>

                            </div>


                            <p class="mt-0.5 text-xs text-gray-500">

                                {{ $programa->objetivos->count() }}
                                objetivos asociados

                            </p>

                        </td>


                        <!-- Período -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600 whitespace-nowrap">

                            {{ $programa->periodo_inicio }}–{{ $programa->periodo_fin }}

                        </td>


                        <!-- Proyectos -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">

                            {{ $programa->proyectos_count }}

                        </td>


                        <!-- Estado del proceso -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @php
                                $claseProceso = match($programa->estado_proceso) {
                                    'Priorizado' => 'bg-green-100 text-green-700',
                                    'En revisión' => 'bg-blue-100 text-blue-700',
                                    'Observado' => 'bg-yellow-100 text-yellow-700',
                                    'Negado' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <span class="inline-flex rounded-full px-3 py-1 text-xs {{ $claseProceso }}">

                                {{ $programa->estado_proceso ?: 'Sin estado' }}

                            </span>

                        </td>


                        <!-- Estado administrativo -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($programa->estado === 'Activo')

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

                        <td colspan="8"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen programas de inversión registrados.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosPrograma" class="hidden">

                    <td colspan="8"
                        class="px-4 py-6 text-center text-sm text-gray-500"
                        role="status"
                        aria-live="polite">

                        No se encontraron programas con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>