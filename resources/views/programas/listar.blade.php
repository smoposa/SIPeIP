<x-programas-layout title="Programas">

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
            Programas Institucionales
        </h2>

    </div>

    <!-- Resumen -->
    <div class="flex items-center justify-between mb-4">

        <div>

            <p class="text-sm text-gray-500">

                {{ $programas->count() }} registros ·

                <span class="text-green-600 font-medium">
                    {{ $programas->where('estado', 'Activo')->count() }}
                </span>

                activos ·

                <span class="text-red-600 font-medium">
                    {{ $programas->where('estado', 'Inactivo')->count() }}
                </span>

                inactivos

            </p>

        </div>

        <a href="{{ route('programas.create') }}"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">

            <i class="bi bi-plus-lg"></i>

            Crear programa

        </a>

    </div>

    <!-- Tabla -->
    <div class="overflow-y-auto" style="height: calc(100vh - 210px);">

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
                            Programa
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Estado
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($programas as $programa)

                        <tr class="border-b border-gray-100 hover:bg-gray-50">

                            <!-- Nro -->
                            <td class="px-2 py-2 text-sm text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <!-- Código -->
                            <td class="px-2 py-2 text-sm text-gray-600">
                                {{ $programa->codigo }}
                            </td>

                            <!-- Programa -->
                            <td class="px-2 py-2">

                                <a href="{{ route('programas.detalle', $programa->id) }}"
                                    class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">

                                    {{ \Illuminate\Support\Str::limit($programa->nombre, 120) }}

                                </a>

                                <div class="mt-1 text-xs">

                                    <span class="font-medium text-gray-600">
                                        Responsable:
                                    </span>

                                    <span class="text-gray-500">
                                        {{ $programa->responsable?->nombres ?? 'No registra' }}
                                        {{ $programa->responsable?->apellidos ?? '' }}
                                    </span>

                                </div>

                                <div class="text-xs">

                                    <span class="font-medium text-gray-600">
                                        Objetivos asociados:
                                    </span>

                                    <span class="text-gray-500">
                                        {{ $programa->objetivos->count() }}
                                    </span>

                                </div>

                            </td>

                            <!-- Estado -->
                            <td class="px-2 py-2">

                                @if($programa->estado == 'Activo')

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

                            <td colspan="4"
                                class="px-4 py-6 text-center text-gray-500">

                                No existen programas registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Pie -->
    <div class="flex items-center justify-between mt-6">

        <p class="text-sm text-gray-600">

            Mostrando

            <span class="font-medium">
                {{ $programas->firstItem() ?? 0 }}
            </span>

            a

            <span class="font-medium">
                {{ $programas->lastItem() ?? 0 }}
            </span>

            de

            <span class="font-medium">
                {{ $programas->total() }}
            </span>

            registros.

        </p>

        {{ $programas->links() }}

    </div>

</x-programas-layout>