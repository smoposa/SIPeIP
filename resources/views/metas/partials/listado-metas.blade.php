<!-- Listado de metas institucionales -->
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
                        Meta institucional
                    </th>

                    <th scope="col"
                        class="w-28 px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($metas as $meta)

                    <tr
                        class="fila-meta border-b border-gray-100
                               hover:bg-gray-50 transition"
                        data-codigo="{{ $meta->codigo }}"
                        data-nombre="{{ $meta->nombre }}"
                        data-objetivo="{{ $meta->objetivo?->codigo }} {{ $meta->objetivo?->nombre }}"
                        data-plan="{{ $meta->objetivo?->plan?->codigo }} {{ $meta->objetivo?->plan?->nombre }}"
                        data-responsable="{{ $meta->responsable?->nombres }} {{ $meta->responsable?->apellidos }}"
                        data-estado="{{ $meta->estado }}"
                    >

                        <!-- Número -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">

                            {{ $metas->firstItem() + $loop->index }}

                        </td>


                        <!-- Código -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">

                            {{ $meta->codigo }}

                        </td>


                        <!-- Meta y datos relacionados -->
                        <td class="px-2 py-2 text-xs max-w-md">

                            <a href="{{ route('metas.detalle', $meta->id) }}"
                               title="Ver detalle de {{ $meta->nombre }}"
                               class="font-medium text-blue-600 hover:text-blue-800
                                      hover:underline">

                                <span class="block line-clamp-2 break-words">
                                    {{ $meta->nombre }}
                                </span>

                            </a>


                            <!-- Objetivo -->
                            <div class="mt-1 break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Objetivo:
                                </span>

                                <span class="text-gray-500">

                                    {{ $meta->objetivo?->codigo ?? 'No registra' }}

                                    @if($meta->objetivo?->nombre)
                                        - {{ $meta->objetivo->nombre }}
                                    @endif

                                </span>

                            </div>


                            <!-- Plan -->
                            <div class="break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Plan:
                                </span>

                                <span class="text-gray-500">

                                    {{ $meta->objetivo?->plan?->codigo ?? 'No registra' }}

                                    @if($meta->objetivo?->plan?->nombre)
                                        - {{ $meta->objetivo->plan->nombre }}
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
                                        ($meta->responsable?->nombres ?? '') . ' ' .
                                        ($meta->responsable?->apellidos ?? '')
                                    ) ?: 'No registra' }}

                                </span>

                            </div>

                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($meta->estado === 'Activo')

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

                            No existen metas institucionales registradas.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosMeta" class="hidden">

                    <td colspan="4"
                        class="px-4 py-6 text-center text-sm text-gray-500"
                        role="status"
                        aria-live="polite">

                        No se encontraron metas con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>