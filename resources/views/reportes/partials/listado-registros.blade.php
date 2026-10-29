<!-- Resultados del reporte -->
<div class="border border-gray-200 rounded-lg overflow-hidden bg-white">

    <div class="overflow-auto"
         style="max-height: calc(100vh - 360px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th scope="col"
                        class="px-4 py-2 text-center text-sm font-semibold text-gray-700">
                        Nro.
                    </th>

                    @foreach($columnas as $columna)

                        <th scope="col"
                            class="px-2 py-2 text-left text-sm font-semibold text-gray-700">

                            {{ $columna }}

                        </th>

                    @endforeach

                </tr>

            </thead>


            <tbody>

                @forelse($registros as $registro)

                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <!-- Número -->
                        <td class="px-4 py-2 text-center text-sm text-gray-600">

                            {{ $registros->firstItem() + $loop->index }}

                        </td>


                        <!-- Columnas del reporte -->
                        @foreach($service->fila($tipo, $registro) as $valor)

                            <td class="px-2 py-2 text-xs text-gray-600">

                                {{ is_float($valor)
                                    ? number_format($valor, 2, ',', '.')
                                    : ($valor ?? '—') }}

                            </td>

                        @endforeach

                    </tr>

                @empty

                    <tr>

                        <td colspan="{{ count($columnas) + 1 }}"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen registros para los filtros seleccionados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>