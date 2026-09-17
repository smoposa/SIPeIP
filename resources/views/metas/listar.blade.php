<x-objetivos-layout title="Metas">

    <!-- Mensaje de éxito -->
    @if(session('success'))

        <div id="alertSuccess"
             class="fixed top-5 right-5 z-50 rounded-lg bg-green-600 px-6 py-3 text-white shadow-lg">

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

    <div class="min-w-0 w-full max-w-full">

        <!-- Encabezado -->
        <div class="mb-2">

            <h2 class="text-2xl font-semibold text-gray-800">
                Metas Institucionales
            </h2>

        </div>

        <!-- Resumen y acción -->
        <div class="mb-4 flex flex-wrap items-center justify-between gap-4">

            <p class="text-sm text-gray-500">

                {{ $totalMetas }} registros ·

                <span class="font-medium text-green-600">
                    {{ $metasActivas }}
                </span>

                activos ·

                <span class="font-medium text-red-600">
                    {{ $metasInactivas }}
                </span>

                inactivos

            </p>

            <a href="{{ route('metas.create') }}"
               class="inline-flex h-10 items-center gap-2 rounded-md bg-blue-600 px-4 text-sm font-medium text-white transition hover:bg-blue-700">

                <i class="bi bi-plus-lg"></i>

                Crear meta

            </a>

        </div>

        <!-- Scroll -->
        <div class="min-w-0 w-full max-w-full overflow-y-auto"
             style="
                height: calc(100vh - 175px);
                overflow-x: hidden;
             ">

            <!-- Tabla -->
            <div class="min-w-0 overflow-hidden rounded-lg border border-gray-200 bg-white">

                <table class="w-full table-fixed">

                    <thead class="sticky top-0 z-10 border-b border-gray-200 bg-gray-50">

                        <tr>

                            <th class="w-16 px-3 py-2 text-left text-sm font-semibold text-gray-700">
                                Nro.
                            </th>

                            <th class="w-32 px-3 py-2 text-left text-sm font-semibold text-gray-700">
                                Código
                            </th>

                            <th class="px-3 py-2 text-left text-sm font-semibold text-gray-700">
                                Meta
                            </th>

                            <th class="w-28 px-3 py-2 text-left text-sm font-semibold text-gray-700">
                                Estado
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($metas as $meta)

                            <tr class="border-b border-gray-100 hover:bg-gray-50">

                                <!-- Número -->
                                <td class="px-3 py-3 text-sm text-gray-600">

                                    {{ $metas->firstItem() + $loop->index }}

                                </td>

                                <!-- Código -->
                                <td class="px-3 py-3 text-sm text-gray-600">

                                    {{ $meta->codigo }}

                                </td>

                                <!-- Meta -->
                                <td class="min-w-0 px-3 py-3">

                                    <a href="{{ route('metas.detalle', $meta->id) }}"
                                       class="break-words text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">

                                        {{ \Illuminate\Support\Str::limit(
                                            $meta->nombre,
                                            100
                                        ) }}

                                    </a>

                                    <div class="mt-1 min-w-0 text-xs">

                                        <span class="font-medium text-gray-600">
                                            Objetivo:
                                        </span>

                                        <span class="break-words text-gray-500">

                                            {{ $meta->objetivo?->codigo ?? 'No registra' }}

                                            @if($meta->objetivo?->nombre)
                                                -
                                                {{ \Illuminate\Support\Str::limit(
                                                    $meta->objetivo->nombre,
                                                    80
                                                ) }}
                                            @endif

                                        </span>

                                    </div>

                                    <div class="min-w-0 text-xs">

                                        <span class="font-medium text-gray-600">
                                            Plan:
                                        </span>

                                        <span class="break-words text-gray-500">

                                            {{ $meta->objetivo?->plan?->codigo ?? 'No registra' }}

                                            @if($meta->objetivo?->plan?->nombre)
                                                -
                                                {{ \Illuminate\Support\Str::limit(
                                                    $meta->objetivo->plan->nombre,
                                                    80
                                                ) }}
                                            @endif

                                        </span>

                                    </div>

                                    <div class="min-w-0 text-xs">

                                        <span class="font-medium text-gray-600">
                                            Responsable:
                                        </span>

                                        <span class="break-words text-gray-500">

                                            {{ $meta->responsable?->nombres ?? 'No registra' }}
                                            {{ $meta->responsable?->apellidos }}

                                        </span>

                                    </div>

                                </td>

                                <!-- Estado -->
                                <td class="px-3 py-3">

                                    @if($meta->estado === 'Activo')

                                        <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                                            Activo
                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                                            Inactivo
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="px-4 py-8 text-center text-sm text-gray-500">

                                    No existen metas institucionales registradas.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pie -->
            <div class="mt-5">

                <p class="text-sm text-gray-600">

                    Mostrando

                    <span class="font-medium">
                        {{ $metas->firstItem() ?? 0 }}
                    </span>

                    a

                    <span class="font-medium">
                        {{ $metas->lastItem() ?? 0 }}
                    </span>

                    de

                    <span class="font-medium">
                        {{ $metas->total() }}
                    </span>

                    registros.

                </p>

                @if($metas->hasPages())

                    <div class="mt-4">
                        {{ $metas->links() }}
                    </div>

                @endif

            </div>

        </div>

    </div>

</x-objetivos-layout>