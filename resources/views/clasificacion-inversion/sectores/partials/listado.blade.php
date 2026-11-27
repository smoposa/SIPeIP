
<!-- Listado de sectores -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <div class="overflow-auto"
         style="height: calc(100vh - 310px); min-height: 220px;">

        <table class="min-w-full">

            <!-- Encabezado -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>
                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Sector
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Subsectores
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

                @forelse($registros as $registro)

                    <tr class="fila-clasificacion border-b border-gray-100 hover:bg-gray-50 transition"
                        data-nombre="{{ $registro->nombre }}"
                        data-codigo="{{ $registro->codigo ?? '' }}"
                        data-estado="{{ $registro->estado }}">

                        <!-- Numeración consecutiva -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">
                            {{ $registros->firstItem() + $loop->index }}
                        </td>

                        <!-- Nombre del sector -->
                        <td class="w-96 max-w-sm px-2 py-2 text-xs font-medium text-gray-700">

                            <a href="{{ route('clasificacion-inversion.subsectores.index', ['sector' => $registro->id]) }}"
                               title="Ver subsectores de {{ $registro->nombre }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                <span class="block line-clamp-2">
                                    {{ $registro->nombre }}
                                </span>

                            </a>

                        </td>

                        <!-- Cantidad de subsectores -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">
                            {{ $registro->subsectores_count }}
                        </td>

                        <!-- Estado -->
                        <td class="px-2 py-2 whitespace-nowrap">

                            @if($registro->estado === 'Activo')

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

                            <button type="button"
                                    data-ver-clasificacion="{{ $registro->id }}"
                                    title="Ver detalle"
                                    aria-label="Ver detalle de {{ $registro->nombre }}"
                                    aria-haspopup="dialog"
                                    aria-controls="panelClasificacion"
                                    class="text-xs text-blue-600 hover:text-blue-800 hover:underline">
                                Detalle
                            </button>

                        </td>

                    </tr>

                @empty

                    <!-- Sin registros -->
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">

                            @if(request()->filled('buscar') || request()->filled('estado'))

                                No se encontraron registros con los filtros seleccionados.

                            @else

                                No existen registros en este nivel de clasificación.

                            @endif

                        </td>
                    </tr>

                @endforelse

                <!-- Sin resultados de búsqueda -->
                <tr id="sinResultadosClasificacion" class="hidden">
                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                        No se encontraron registros con los filtros seleccionados.
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

    <!-- Paginación -->
    <x-pagination :paginator="$registros" />

</div>
