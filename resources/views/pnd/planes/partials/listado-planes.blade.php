<!-- Listado de planes nacionales -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 260px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Plan nacional
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Ejes
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Objetivos
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Período
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Información
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($planes as $plan)

                    <tr
                        class="fila-plan-pnd border-b border-gray-100 hover:bg-gray-50 transition"
                        data-nombre="{{ $plan->nombre }}"
                        data-periodo="{{ $plan->periodo_inicio }}–{{ $plan->periodo_fin }}"
                        data-estado="{{ $plan->estado }}"
                    >

                        <!-- Nro -->
                        <td class="px-4 py-2 text-sm text-gray-600 text-center">
                            {{ $planes->firstItem() + $loop->index }}
                        </td>


                        <!-- Plan nacional -->
                        <td class="px-2 py-2 text-xs font-medium max-w-md">

                            <a href="{{ route('pnd.ejes.index', ['pnd' => $plan->id]) }}"
                               title="Ver ejes de {{ $plan->nombre }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                <span class="block line-clamp-2">
                                    {{ $plan->nombre }}
                                </span>

                            </a>

                        </td>


                        <!-- Ejes -->
                        <td class="px-2 py-2 text-xs text-gray-600 text-center">
                            {{ $plan->ejes_count }}
                        </td>

                        <!-- Total de objetivos de todos los ejes -->
                        <td class="px-2 py-2 text-xs text-gray-600 text-center">
                            {{ $plan->ejes->sum('objetivos_count') }}
                        </td>


                        <!-- Período -->
                        <td class="px-2 py-2 text-xs text-center text-gray-600 whitespace-nowrap">
                            {{ $plan->periodo_inicio }}–{{ $plan->periodo_fin }}
                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 text-center whitespace-nowrap">

                            @if($plan->estado === 'Activo')

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
                                data-ver-plan="{{ $plan->id }}"
                                title="Ver detalle del plan"
                                aria-label="Ver detalle de {{ $plan->nombre }}"
                                aria-haspopup="dialog"
                                aria-controls="panelPlanPnd"
                                class="text-xs text-blue-600 hover:text-blue-800 hover:underline">

                                Detalle

                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen planes nacionales registrados.

                        </td>

                    </tr>

                @endforelse


                <!-- Sin coincidencias -->
                <tr id="sinResultadosPlanPnd" class="hidden">

                    <td colspan="6"
                        class="px-4 py-6 text-center text-sm text-gray-500">

                        No se encontraron planes con los filtros seleccionados.

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>