<!-- Listado de indicadores institucionales -->
<div class="border border-gray-200 rounded-lg overflow-hidden bg-white">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 260px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th scope="col"
                        class="w-16 px-4 py-2 text-center text-sm font-semibold text-gray-700">
                        Nro.
                    </th>

                    <th scope="col"
                        class="w-32 px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Código
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Indicador institucional
                    </th>

                    <th scope="col"
                        class="w-28 px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($indicadores as $indicador)

                    <tr
                        class="fila-indicador border-b border-gray-100
                               hover:bg-gray-50 transition"
                        data-codigo="{{ $indicador->codigo }}"
                        data-nombre="{{ $indicador->nombre }}"
                        data-meta="{{ $indicador->meta?->codigo }}"
                        data-responsable="{{ $indicador->responsable?->nombres }} {{ $indicador->responsable?->apellidos }}"
                        data-estado="{{ $indicador->estado }}"
                    >

                        <!-- Número -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">

                            {{ $loop->iteration }}

                        </td>


                        <!-- Código -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">

                            {{ $indicador->codigo }}

                        </td>


                        <!-- Indicador y datos relacionados -->
                        <td class="px-2 py-2 text-xs max-w-md">

                            <a href="{{ route('indicadores.detalle', $indicador->id) }}"
                               title="Ver detalle de {{ $indicador->nombre }}"
                               class="font-medium text-blue-600 hover:text-blue-800
                                      hover:underline">

                                <span class="block line-clamp-2 break-words">
                                    {{ $indicador->nombre }}
                                </span>

                            </a>


                            <!-- Meta -->
                            <div class="mt-1 break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Meta:
                                </span>

                                <span class="text-gray-500">
                                    {{ $indicador->meta?->codigo ?? 'No registra' }}
                                </span>

                            </div>


                            <!-- Responsable -->
                            <div class="break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Responsable:
                                </span>

                                <span class="text-gray-500">

                                    {{ trim(
                                        ($indicador->responsable?->nombres ?? '') . ' ' .
                                        ($indicador->responsable?->apellidos ?? '')
                                    ) ?: 'No registra' }}

                                </span>

                            </div>

                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($indicador->estado === 'Activo')

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

                        <td colspan="4"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen indicadores institucionales registrados.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosIndicador" class="hidden">

                    <td colspan="4"
                        class="px-4 py-6 text-center text-sm text-gray-500"
                        role="status"
                        aria-live="polite">

                        No se encontraron indicadores con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>