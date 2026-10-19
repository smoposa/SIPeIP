<!-- Listado de ejes -->
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
                        Eje
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Objetivos
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Políticas
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


            <tbody>

                @forelse($pnd->ejes as $eje)

                    <tr
                        class="fila-eje-pnd border-b border-gray-100 hover:bg-gray-50 transition"
                        data-numero="{{ $eje->numero }}"
                        data-nombre="{{ $eje->nombre }}"
                        data-estado="{{ $eje->estado }}"
                    >

                        <!-- Nro -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">
                            {{ $loop->iteration }}
                        </td>


                        <!-- Eje -->
                        <td class="px-2 py-2 text-xs font-medium">

                            <a href="{{ route('pnd.objetivos.index', ['eje' => $eje->id]) }}"
                               title="Ver objetivos de {{ $eje->nombre }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                {{ $eje->nombre }}

                            </a>

                        </td>


                        <!-- Objetivos -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">
                            {{ $eje->objetivos_count }}
                        </td>


                        <!-- Políticas -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">
                            {{ $eje->objetivos->sum('politicas_count') }}
                        </td>


                        <!-- Metas -->
                        <td class="px-2 py-2 text-center text-xs text-gray-600">
                            {{ $eje->objetivos->sum('metas_count') }}
                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 whitespace-nowrap">

                            @if($eje->estado === 'Activo')

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
                                data-ver-eje-pnd="{{ $eje->id }}"
                                title="Ver detalle del eje"
                                aria-label="Ver detalle de {{ $eje->nombre }}"
                                aria-haspopup="dialog"
                                aria-controls="panelEjePnd"
                                class="text-xs text-blue-600 hover:text-blue-800 hover:underline">

                                Detalle

                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen ejes registrados en este plan.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosEjePnd" class="hidden">

                    <td colspan="7"
                        class="px-4 py-6 text-center text-sm text-gray-500">

                        No se encontraron ejes con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>