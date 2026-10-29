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
                        Proyecto
                    </th>

                    <th scope="col"
                        class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Período
                    </th>

                    @foreach(['Programado', 'Vigente', 'Ejecutado'] as $encabezado)

                        <th scope="col"
                            class="px-2 py-2 text-right text-sm font-semibold text-gray-700">
                            {{ $encabezado }}
                        </th>

                    @endforeach

                    @foreach(['Ejecución', 'Estado', 'Acciones'] as $encabezado)

                        <th scope="col"
                            class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                            {{ $encabezado }}
                        </th>

                    @endforeach

                </tr>

            </thead>


            <tbody>

                @forelse($presupuestos as $presupuesto)

                    <tr
                        class="fila-presupuesto border-b border-gray-100
                               hover:bg-gray-50 transition"
                        data-proyecto="{{ $presupuesto->proyecto?->codigo }} {{ $presupuesto->proyecto?->nombre }}"
                        data-periodo="{{ $presupuesto->periodo }}"
                        data-anio="{{ $presupuesto->anio }}"
                        data-estado="{{ $presupuesto->estado }}"
                    >

                        <!-- Número -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">
                            {{ $presupuestos->firstItem() + $loop->index }}
                        </td>


                        <!-- Proyecto -->
                        <td class="px-2 py-2 text-xs max-w-md">

                            <a href="{{ route('presupuestos.detalle', $presupuesto) }}"
                               class="font-medium text-blue-600 hover:text-blue-800 hover:underline">

                                <span class="block line-clamp-2 break-words">
                                    {{ $presupuesto->proyecto?->codigo }}
                                    -
                                    {{ $presupuesto->proyecto?->nombre ?? 'Proyecto no disponible' }}
                                </span>

                            </a>

                            <p class="mt-1 text-xs text-gray-500">

                                <span class="font-medium text-gray-600">
                                    Aprobado:
                                </span>

                                @if($presupuesto->proyecto)

                                    USD {{ number_format(
                                        (float) $presupuesto->proyecto->presupuesto_aprobado,
                                        2
                                    ) }}

                                @else

                                    No registra

                                @endif

                            </p>

                        </td>


                        <!-- Período -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600 whitespace-nowrap">

                            {{ $presupuesto->periodo }}

                            <span class="mt-1 block text-gray-500">
                                {{ $presupuesto->anio }}
                            </span>

                        </td>


                        <!-- Montos -->
                        @foreach([
                            $presupuesto->monto_programado,
                            $presupuesto->presupuesto_vigente,
                            $presupuesto->monto_ejecutado
                        ] as $monto)

                            <td class="px-2 py-2 text-right text-xs text-gray-600 whitespace-nowrap">
                                USD {{ number_format((float) $monto, 2) }}
                            </td>

                        @endforeach


                        <!-- Ejecución -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            <span class="text-xs font-semibold {{
                                $presupuesto->alerta === 'Cumplido'
                                    ? 'text-green-700'
                                    : ($presupuesto->alerta === 'En riesgo'
                                        ? 'text-amber-700'
                                        : 'text-red-700')
                            }}">
                                {{ number_format($presupuesto->porcentaje_ejecucion, 2) }}%
                            </span>

                            <p class="mt-1 text-xs text-gray-500">
                                {{ $presupuesto->alerta }}
                            </p>

                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($presupuesto->estado === 'Cerrado')

                                <span class="inline-flex items-center gap-1.5 text-xs text-green-600">
                                    <i class="bi bi-lock" aria-hidden="true"></i>
                                    Cerrado
                                </span>

                            @elseif($presupuesto->estado === 'Borrador')

                                <span class="inline-flex items-center gap-1.5 text-xs text-gray-600">
                                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                    Borrador
                                </span>

                            @else

                                <span class="text-xs text-gray-500">
                                    {{ $presupuesto->estado ?: 'Sin estado' }}
                                </span>

                            @endif

                        </td>


                        <!-- Acciones -->
                        <td class="px-2 py-2">

                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('presupuestos.detalle', $presupuesto) }}"
                                   title="Ver detalle"
                                   aria-label="Ver presupuesto de {{ $presupuesto->proyecto?->codigo }}, {{ $presupuesto->periodo }} {{ $presupuesto->anio }}"
                                   class="inline-flex h-8 w-8 items-center justify-center rounded-md
                                          border border-gray-300 text-gray-600 transition hover:bg-gray-100">

                                    <i class="bi bi-eye" aria-hidden="true"></i>

                                </a>

                                @if($presupuesto->estado === 'Borrador' && puedeHacer('presupuestos', 'editar'))

                                    <a href="{{ route('presupuestos.edit', $presupuesto) }}"
                                       title="Editar presupuesto"
                                       aria-label="Editar presupuesto de {{ $presupuesto->proyecto?->codigo }}, {{ $presupuesto->periodo }} {{ $presupuesto->anio }}"
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

                        <td colspan="9"
                            class="px-4 py-6 text-center text-sm text-gray-500">
                            No existen presupuestos registrados.
                        </td>

                    </tr>

                @endforelse


                <tr id="sinResultadosPresupuesto" class="hidden">

                    <td colspan="9"
                        role="status"
                        aria-live="polite"
                        class="px-4 py-6 text-center text-sm text-gray-500">

                        No se encontraron presupuestos con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>