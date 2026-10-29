<div class="border border-gray-200 rounded-lg overflow-hidden bg-white">

    <div class="overflow-auto"
         style="height: calc(100vh - 260px);">

        <table class="min-w-full">

            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th scope="col"
                        class="px-4 py-2 text-center text-sm font-semibold text-gray-700">
                        Nro.
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Proyecto / Indicador
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Período
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-right text-sm font-semibold text-gray-700">
                        Programado
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-right text-sm font-semibold text-gray-700">
                        Ejecutado
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Cumplimiento
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Acciones
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($avances as $avance)

                    <tr
                        class="fila-avance border-b border-gray-100 hover:bg-gray-50 transition"
                        data-proyecto="{{ $avance->proyecto?->codigo }} {{ $avance->proyecto?->nombre }}"
                        data-indicador="{{ $avance->indicador?->codigo }} {{ $avance->indicador?->nombre }}"
                        data-periodo="{{ $avance->periodo }}"
                        data-anio="{{ $avance->anio }}"
                        data-estado="{{ $avance->estado }}"
                    >

                        <td class="px-4 py-2 text-center text-sm text-gray-600">
                            {{ $avances->firstItem() + $loop->index }}
                        </td>


                        <td class="px-2 py-2 text-xs max-w-md">

                            <a href="{{ route('avances.detalle', $avance) }}"
                               class="font-medium text-blue-600 hover:text-blue-800 hover:underline">

                                <span class="block line-clamp-2 break-words">
                                    {{ $avance->proyecto?->codigo }}
                                    -
                                    {{ $avance->proyecto?->nombre ?? 'Proyecto no disponible' }}
                                </span>

                            </a>

                            <p class="mt-1 break-words text-xs text-gray-500">

                                <span class="font-medium text-gray-600">
                                    Indicador:
                                </span>

                                {{ $avance->indicador?->codigo }}
                                -
                                {{ $avance->indicador?->nombre ?? 'No registra' }}

                            </p>

                        </td>


                        <td class="px-2 py-2 text-center text-xs text-gray-600 whitespace-nowrap">

                            {{ $avance->periodo }}

                            <span class="mt-1 block text-gray-500">
                                {{ $avance->anio }}
                            </span>

                        </td>


                        <td class="px-2 py-2 text-right text-xs text-gray-600 whitespace-nowrap">
                            {{ number_format((float) $avance->valor_programado, 4) }}
                        </td>


                        <td class="px-2 py-2 text-right text-xs text-gray-600 whitespace-nowrap">
                            {{ number_format((float) $avance->valor_ejecutado, 4) }}
                        </td>


                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            <span class="text-xs font-semibold {{
                                $avance->alerta === 'Cumplido'
                                    ? 'text-green-700'
                                    : ($avance->alerta === 'En riesgo'
                                        ? 'text-amber-700'
                                        : 'text-red-700')
                            }}">
                                {{ number_format($avance->porcentaje_cumplimiento, 2) }}%
                            </span>

                            <p class="mt-1 text-xs text-gray-500">
                                {{ $avance->alerta }}
                            </p>

                        </td>


                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($avance->estado === 'Cerrado')

                                <span class="inline-flex items-center gap-1.5 text-xs text-green-600">
                                    <i class="bi bi-lock" aria-hidden="true"></i>
                                    Cerrado
                                </span>

                            @elseif($avance->estado === 'Borrador')

                                <span class="inline-flex items-center gap-1.5 text-xs text-gray-600">
                                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                    Borrador
                                </span>

                            @else

                                <span class="text-xs text-gray-500">
                                    {{ $avance->estado ?: 'Sin estado' }}
                                </span>

                            @endif

                        </td>


                        <td class="px-2 py-2">

                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('avances.detalle', $avance) }}"
                                   title="Ver detalle"
                                   aria-label="Ver avance de {{ $avance->proyecto?->codigo }}, {{ $avance->periodo }} {{ $avance->anio }}"
                                   class="inline-flex h-8 w-8 items-center justify-center rounded-md
                                          border border-gray-300 text-gray-600 transition hover:bg-gray-100">

                                    <i class="bi bi-eye" aria-hidden="true"></i>

                                </a>

                                @if($avance->estado === 'Borrador' && puedeHacer('avances', 'editar'))

                                    <a href="{{ route('avances.edit', $avance) }}"
                                       title="Editar avance"
                                       aria-label="Editar avance de {{ $avance->proyecto?->codigo }}, {{ $avance->periodo }} {{ $avance->anio }}"
                                       class="inline-flex h-8 w-8 items-center justify-center rounded-md
                                              border border-gray-300 text-gray-600 transition hover:bg-gray-100">

                                        <i class="bi bi-pencil" aria-hidden="true"></i>

                                    </a>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8"
                            class="px-4 py-6 text-center text-sm text-gray-500">
                            No existen avances registrados.
                        </td>
                    </tr>

                @endforelse


                <tr id="sinResultadosAvance" class="hidden">

                    <td colspan="8"
                        role="status"
                        aria-live="polite"
                        class="px-4 py-6 text-center text-sm text-gray-500">

                        No se encontraron avances con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>