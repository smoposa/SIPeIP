
<!-- Listado de objetivos ODS -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 290px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Código
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Objetivo
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Metas
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Información
                    </th>

                </tr>

            </thead>


            <!-- Registros -->
            <tbody>

                @forelse($ods as $item)

                    <tr class="fila-objetivo border-b border-gray-100 hover:bg-gray-50 transition">

                        <!-- Nro -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">

                            {{ $ods->firstItem() + $loop->index }}

                        </td>


                        <!-- Código -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600 whitespace-nowrap">

                            {{ $item->codigo }}

                        </td>


                        <!-- Objetivo -->
                        <td class="px-2 py-2 text-xs font-medium">

                            <a href="{{ route('ods.metas.index', ['ods' => $item->id]) }}"
                               title="Ver metas de {{ $item->nombre }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                {{ $item->nombre }}

                            </a>

                        </td>


                        <!-- Metas -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">

                            {{ $item->metas_count }}

                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

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

                            No se encontraron registros.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <!-- Paginación -->
    <x-pagination :paginator="$ods" />

</div>
