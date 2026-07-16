<x-objetivos-layout title="OEI">

    @if(session('success'))
        <div id="alertSuccess"
            class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
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
            Objetivos Estratégicos Institucionales
        </h2>

        <!--<p class="mt-1 text-gray-500">
            Consulte y administre los Objetivos Estratégicos Institucionales.
        </p>-->

    </div>

    <!-- Resumen -->
    <div class="flex items-center justify-between mb-4">

        <div>

            <p class="text-sm text-gray-500">
                {{ $objetivos->count() }} registros ·
                <span class="text-green-600 font-medium">
                    {{ $objetivos->where('estado', 'Activo')->count() }}
                </span>
                activos ·
                <span class="text-red-600 font-medium">
                    {{ $objetivos->where('estado', 'Inactivo')->count() }}
                </span>
                inactivos
            </p>

        </div>

        <a href="{{ route('objetivos.create') }}"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">

            <i class="bi bi-plus-lg"></i>

            Crear objetivo

        </a>

    </div>

    <!-- Tabla -->
    <div class="overflow-y-auto" style="height: calc(100vh - 160px);">

        <div class="bg-white border border-gray-200 rounded-lg">

            <table class="min-w-full">

                <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                    <tr>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Nro
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Código
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Nombre
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Estado
                        </th>

                    </tr>

                </thead>

                <tbody>
                                        @forelse($objetivos as $objetivo)

                        <tr class="border-b border-gray-100 hover:bg-gray-50">

                            <!-- Nro -->
                            <td class="px-2 py-2 text-sm text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <!-- Código -->
                            <td class="px-2 py-2 text-sm text-gray-600">
                                {{ $objetivo->codigo }}
                            </td>

                            <!-- Nombre -->
                            <td class="px-2 py-2">

                                <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                                class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">

                                    {{ \Illuminate\Support\Str::limit($objetivo->nombre, ) }}

                                </a>

                                <div class="mt-1 text-xs">

                                    <span class="font-medium text-gray-600">Entidad: </span>
                                    <span class="text-gray-500">
                                        {{ $objetivo->plan?->entidad?->nombre ?? 'No registra' }}
                                    </span>

                                </div>

                                <div class="text-xs">

                                    <span class="font-medium text-gray-600">Plan: </span>
                                    <span class="text-gray-500">
                                        {{ \Illuminate\Support\Str::limit($objetivo->plan?->nombre ?? 'No registra',) }}
                                    </span>

                                </div>

                            </td>

                            <!-- Estado -->
                            <td class="px-2 py-2">

                                @if($objetivo->estado == 'Activo')

                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Activo
                                    </span>

                                @else

                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="px-4 py-6 text-center text-gray-500">

                                No existen Objetivos Estratégicos Institucionales registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
            <!-- Pie de tabla -->
    <div class="flex items-center justify-between mt-6">

        <p class="text-sm text-gray-600">
            Mostrando <span class="font-medium">{{ $objetivos->count() }}</span> registros.
        </p>

    </div>

</x-objetivos-layout>