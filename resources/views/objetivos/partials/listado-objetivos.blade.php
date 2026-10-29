<!-- Listado de objetivos estratégicos institucionales -->
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
                        Objetivo institucional
                    </th>

                    <th scope="col"
                        class="w-28 px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($objetivos as $objetivo)

                    <tr
                        class="fila-objetivo border-b border-gray-100
                               hover:bg-gray-50 transition"
                        data-codigo="{{ $objetivo->codigo }}"
                        data-nombre="{{ $objetivo->nombre }}"
                        data-entidad="{{ $objetivo->plan?->entidad?->nombre ?? '' }}"
                        data-plan="{{ $objetivo->plan?->nombre ?? '' }}"
                        data-estado="{{ $objetivo->estado }}"
                    >

                        <!-- Número -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">

                            {{ $objetivos->firstItem() + $loop->index }}

                        </td>


                        <!-- Código -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">

                            {{ $objetivo->codigo }}

                        </td>


                        <!-- Nombre, entidad y plan -->
                        <td class="px-2 py-2 text-xs max-w-md">

                            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                               title="Ver detalle de {{ $objetivo->nombre }}"
                               class="font-medium text-blue-600 hover:text-blue-800
                                      hover:underline">

                                <span class="block line-clamp-2 break-words">
                                    {{ $objetivo->nombre }}
                                </span>

                            </a>


                            <div class="mt-1 break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Entidad:
                                </span>

                                <span class="text-gray-500">
                                    {{ $objetivo->plan?->entidad?->nombre ?? 'No registra' }}
                                </span>

                            </div>


                            <div class="break-words text-xs">

                                <span class="font-medium text-gray-600">
                                    Plan:
                                </span>

                                <span class="text-gray-500">
                                    {{ $objetivo->plan?->nombre ?? 'No registra' }}
                                </span>

                            </div>

                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($objetivo->estado === 'Activo')

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

                            No existen objetivos estratégicos institucionales registrados.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosObjetivo" class="hidden">

                    <td colspan="4"
                        class="px-4 py-6 text-center text-sm text-gray-500"
                        role="status"
                        aria-live="polite">

                        No se encontraron objetivos con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>