<!-- Listado de objetivos -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 310px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Objetivo
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Políticas
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Estrategias
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
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


            <!-- Registros -->
            <tbody>

                @forelse($eje->objetivos as $objetivo)

                    <tr
                        class="fila-objetivo-pnd border-b border-gray-100 hover:bg-gray-50 transition"
                        data-numero="{{ $objetivo->numero }}"
                        data-nombre="{{ $objetivo->nombre }}"
                        data-estado="{{ $objetivo->estado }}"
                    >

                        <!-- Nro -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">
                            {{ $loop->iteration }}
                        </td>

                        <!-- Objetivo -->
                        <td class="w-96 max-w-sm px-2 py-2 text-xs font-medium">

                            <a href="{{ route('pnd.objetivo', ['id' => $objetivo->id]) }}"
                               title="Ver políticas, estrategias y metas"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                <span class="block line-clamp-2">
                                    {{ $objetivo->nombre }}
                                </span>

                            </a>

                        </td>


                        <!-- Políticas -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">
                            {{ $objetivo->politicas_count }}
                        </td>


                        <!-- Estrategias -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">
                            {{ $objetivo->politicas->sum('estrategias_count') }}
                        </td>


                        <!-- Metas -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">
                            {{ $objetivo->metas_count }}
                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 whitespace-nowrap">

                            @if($objetivo->estado === 'Activo')

                                <span class="inline-flex items-center gap-1.5 text-xs text-green-600">

                                    <i class="bi bi-check-lg" aria-hidden="true"></i>
                                    Activo

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 text-xs text-red-600">

                                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                                    Inactivo

                                </span>

                            @endif

                        </td>


                        <!-- Información -->
                        <td class="px-2 py-2 text-center">

                            <button
                                type="button"
                                data-ver-objetivo-pnd="{{ $objetivo->id }}"
                                title="Ver detalle del objetivo"
                                aria-label="Ver detalle de {{ $objetivo->nombre }}"
                                aria-haspopup="dialog"
                                aria-controls="panelObjetivoPnd"
                                class="text-xs text-blue-600 hover:text-blue-800 hover:underline">

                                Detalle

                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen objetivos registrados en este eje.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosObjetivoPnd" class="hidden">

                    <td colspan="8"
                        class="px-4 py-6 text-center text-sm text-gray-500">

                        No se encontraron objetivos con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>