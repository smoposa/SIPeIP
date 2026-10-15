<!-- Listado de agendas -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 260px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Agenda
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Objetivos
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Período
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

                @forelse($agendas as $agenda)

                    <tr
                        class="fila-agenda border-b border-gray-100 hover:bg-gray-50 transition"
                        data-nombre="{{ $agenda->nombre }}"
                        data-periodo="{{ $agenda->periodo_inicio }}–{{ $agenda->periodo_fin }}"
                        data-estado="{{ $agenda->estado }}"
                    >

                        <!-- Nro -->
                        <td class="px-4 py-2 text-sm text-gray-600">
                            {{ $agendas->firstItem() + $loop->index }}
                        </td>


                        <!-- Agenda -->
                        <td class="px-2 py-2 text-xs font-medium max-w-md">

                            <a href="{{ route('ods.objetivos.index', ['agenda' => $agenda->id]) }}"
                               title="Ver objetivos de {{ $agenda->nombre }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                <span class="block line-clamp-2">
                                    {{ $agenda->nombre }}
                                </span>

                            </a>

                        </td>


                        <!-- Objetivos -->
                        <td class="px-2 py-2 text-xs text-gray-600">
                            {{ $agenda->ods_count }}
                        </td>


                        <!-- Período -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">
                            {{ $agenda->periodo_inicio }}–{{ $agenda->periodo_fin }}
                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 whitespace-nowrap">

                            @if($agenda->estado === 'Activo')

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

                        <!-- Detalle de la agenda -->
                        <td class="px-2 py-2 text-center">

                            <button
                                type="button"
                                data-ver-agenda="{{ $agenda->id }}"
                                title="Ver detalle de la agenda"
                                aria-label="Ver detalle de {{ $agenda->nombre }}"
                                aria-haspopup="dialog"
                                aria-controls="panelAgenda"
                                class="text-xs text-blue-600 hover:text-blue-800 hover:underline">

                                Detalle

                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen agendas registradas.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias del buscador o filtro -->
                <tr id="sinResultadosAgenda" class="hidden">

                    <td colspan="6"
                        class="px-4 py-6 text-center text-sm text-gray-500">

                        No se encontraron registros con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>