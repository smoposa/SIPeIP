<!-- Listado de objetivos -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 240px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Código
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Objetivo
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Metas
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Información
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($ods as $item)

                    <tr
                        class="fila-objetivo border-b border-gray-100 hover:bg-gray-50 transition"
                        data-codigo="{{ $item->codigo }}"
                        data-nombre="{{ $item->nombre }}"
                        data-estado="{{ $item->estado }}"
                    >

                        <!-- Nro -->
                        <td class="px-4 py-2 text-sm text-gray-600">
                            {{ $loop->iteration }}
                        </td>


                        <!-- Código -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">
                            {{ $item->codigo }}
                        </td>


                        <!-- Objetivo -->
                        <td class="w-96 max-w-sm px-2 py-2 text-xs font-medium">

                            <a href="{{ route('ods.metas.index', ['ods' => $item->id]) }}"
                               title="Ver metas de {{ $item->nombre }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                <span class="block line-clamp-2">
                                    {{ $item->nombre }}
                                </span>

                            </a>

                        </td>


                        <!-- Metas -->
                        <td class="px-2 py-2 text-xs text-gray-600">
                            {{ $item->metas_count }}
                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 whitespace-nowrap">

                            @if($item->estado === 'Activo')

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


                        <!-- Información -->
                        <td class="px-2 py-2 text-center">

                            <button
                                type="button"
                                data-ver-objetivo="{{ $item->id }}"
                                title="Ver detalle del objetivo"
                                aria-label="Ver detalle de {{ $item->nombre }}"
                                aria-haspopup="dialog"
                                aria-controls="panelObjetivo"
                                class="text-xs text-blue-600 hover:text-blue-800 hover:underline">

                                Detalle

                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen objetivos registrados en esta agenda.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosObjetivo" class="hidden">

                    <td colspan="6"
                        class="px-4 py-6 text-center text-sm text-gray-500">

                        No se encontraron objetivos con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>