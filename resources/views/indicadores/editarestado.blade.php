<x-objetivos-layout title="Indicadores">

    @if(session('success'))

        <div id="alertSuccess"
             class="fixed right-5 top-5 z-50 rounded-lg
                    bg-green-600 px-6 py-3 text-white shadow-lg">

            {{ session('success') }}

        </div>

        <script>
            setTimeout(() => {
                const alerta = document.getElementById('alertSuccess');

                if (alerta) {
                    alerta.remove();
                }
            }, 3000);
        </script>

    @endif

    <!-- Encabezado -->
    <div class="mb-2">

        <h2 class="text-2xl font-semibold text-gray-800">
            Indicadores Institucionales
        </h2>

    </div>

    <!-- Resumen y acción -->
    <div class="mb-4 flex flex-wrap items-center justify-between gap-4">

        <p class="text-sm text-gray-500">

            <span class="font-medium text-gray-700">
                {{ $totalIndicadores }}
            </span>

            registros ·

            <span class="font-medium text-green-600">
                {{ $indicadoresActivos }}
            </span>

            activos ·

            <span class="font-medium text-red-600">
                {{ $indicadoresInactivos }}
            </span>

            inactivos

        </p>

        @if(puedeHacer('indicadores', 'crear'))

            <a href="{{ route('indicadores.create') }}"
               class="inline-flex h-10 items-center gap-2 rounded-md
                      bg-blue-600 px-4 text-sm font-medium text-white
                      transition hover:bg-blue-700">

                <i class="bi bi-plus-lg"></i>

                Crear indicador

            </a>

        @endif

    </div>

    <!-- Tabla -->
    <div class="min-w-0 w-full overflow-x-hidden overflow-y-auto"
         style="height: calc(100vh - 230px);">

        <div class="min-w-0 rounded-lg border border-gray-200 bg-white">

            <table class="w-full table-fixed">

                <thead class="sticky top-0 z-10 border-b
                              border-gray-200 bg-gray-50">

                    <tr>

                        <th class="w-14 px-2 py-2 text-left
                                   text-sm font-semibold text-gray-700">
                            Nro.
                        </th>

                        <th class="w-28 px-2 py-2 text-left
                                   text-sm font-semibold text-gray-700">
                            Código
                        </th>

                        <th class="px-2 py-2 text-left
                                   text-sm font-semibold text-gray-700">
                            Indicador
                        </th>

                        <th class="w-28 px-2 py-2 text-left
                                   text-sm font-semibold text-gray-700">
                            Estado
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($indicadores as $indicador)

                        <tr class="border-b border-gray-100 hover:bg-gray-50">

                            <!-- Número -->
                            <td class="px-2 py-2 text-sm text-gray-600">

                                {{ $indicadores->firstItem() + $loop->index }}

                            </td>

                            <!-- Código -->
                            <td class="px-2 py-2 text-sm text-gray-600">

                                {{ $indicador->codigo }}

                            </td>

                            <!-- Indicador -->
                            <td class="min-w-0 px-2 py-2">

                                <a href="{{ route('indicadores.detalle', $indicador->id) }}"
                                   class="break-words text-sm font-medium
                                          text-blue-600 hover:text-blue-800
                                          hover:underline">

                                    {{ \Illuminate\Support\Str::limit(
                                        $indicador->nombre,
                                        120
                                    ) }}

                                </a>

                                <div class="mt-1 min-w-0 text-xs">

                                    <span class="font-medium text-gray-600">
                                        Meta:
                                    </span>

                                    <span class="break-words text-gray-500">
                                        {{ $indicador->meta?->codigo ?? 'No registra' }}

                                        @if($indicador->meta?->nombre)
                                            -
                                            {{ \Illuminate\Support\Str::limit(
                                                $indicador->meta->nombre,
                                                70
                                            ) }}
                                        @endif
                                    </span>

                                </div>

                                <div class="min-w-0 text-xs">

                                    <span class="font-medium text-gray-600">
                                        Plan:
                                    </span>

                                    <span class="break-words text-gray-500">
                                        {{ \Illuminate\Support\Str::limit(
                                            $indicador->meta?->objetivo?->plan?->nombre
                                                ?? 'No registra',
                                            80
                                        ) }}
                                    </span>

                                </div>

                                <div class="min-w-0 text-xs">

                                    <span class="font-medium text-gray-600">
                                        Responsable:
                                    </span>

                                    <span class="break-words text-gray-500">
                                        {{ $indicador->responsable?->nombres
                                            ?? 'No registra' }}

                                        {{ $indicador->responsable?->apellidos }}
                                    </span>

                                </div>

                            </td>

                            <!-- Estado -->
                            <td class="px-2 py-2">

                                @if($indicador->estado === 'Activo')

                                    <span class="rounded-full bg-green-100
                                                 px-2 py-1 text-xs text-green-700">
                                        Activo
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100
                                                 px-2 py-1 text-xs text-red-700">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="px-4 py-8 text-center text-gray-500">

                                No existen indicadores registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Paginación -->
    <div class="mt-4">

        {{ $indicadores->links() }}

    </div>

</x-objetivos-layout>