<x-proyectos-layout title="Proyectos">

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

            Proyectos de Inversión

        </h2>

    </div>

    <!-- Resumen -->
    <div class="flex items-center justify-between mb-4">

        <div>

            <p class="text-sm text-gray-500">

                {{ $proyectos->count() }} registros ·

                <span class="text-blue-600 font-medium">
                    {{ $proyectos->where('estado','Planificado')->count() }}
                </span>

                planificados ·

                <span class="text-green-600 font-medium">
                    {{ $proyectos->where('estado','En ejecución')->count() }}
                </span>

                en ejecución

            </p>

        </div>

        <a href="{{ route('proyectos.create') }}"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">

            <i class="bi bi-plus-lg"></i>

            Crear proyecto

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
                            Proyecto
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Estado
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($proyectos as $proyecto)

                        <tr class="border-b border-gray-100 hover:bg-gray-50">

                            <!-- Nro -->
                            <td class="px-2 py-2 text-sm text-gray-600">

                                {{ $loop->iteration }}

                            </td>

                            <!-- Código -->
                            <td class="px-2 py-2 text-sm text-gray-600">

                                {{ $proyecto->codigo }}

                            </td>

                            <!-- Proyecto -->
                            <td class="px-2 py-2">

                                <a href="{{ route('proyectos.detalle', $proyecto->id) }}"
                                    class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">

                                    {{ \Illuminate\Support\Str::limit($proyecto->nombre,120) }}

                                </a>

                                <div class="mt-1 text-xs">

                                    <span class="font-medium text-gray-600">

                                        Programa:

                                    </span>

                                    <span class="text-gray-500">

                                        {{ $proyecto->programa?->codigo }}

                                        -

                                        {{ $proyecto->programa?->nombre }}

                                    </span>

                                </div>

                                <div class="text-xs">

                                    <span class="font-medium text-gray-600">

                                        Responsable:

                                    </span>

                                    <span class="text-gray-500">

                                        {{ $proyecto->responsable?->nombres ?? 'No registra' }}

                                        {{ $proyecto->responsable?->apellidos ?? '' }}

                                    </span>

                                </div>

                                <div class="text-xs">

                                    <span class="font-medium text-gray-600">

                                        Presupuesto:

                                    </span>

                                    <span class="text-gray-500">

                                        $ {{ number_format($proyecto->presupuesto_aprobado,2) }}

                                    </span>

                                </div>

                            </td>

                            <!-- Estado -->
                            <td class="px-2 py-2">

                                @switch($proyecto->estado)

                                    @case('Planificado')

                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">

                                            Planificado

                                        </span>

                                        @break

                                    @case('En ejecución')

                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">

                                            En ejecución

                                        </span>

                                        @break

                                    @case('Finalizado')

                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-700">

                                            Finalizado

                                        </span>

                                        @break

                                    @default

                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">

                                            Suspendido

                                        </span>

                                @endswitch

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="px-4 py-6 text-center text-gray-500">

                                No existen proyectos registrados.

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

                {{ $proyectos->firstItem() ?? 0 }}

            </span>

            a

            <span class="font-medium">

                {{ $proyectos->lastItem() ?? 0 }}

            </span>

            de

            <span class="font-medium">

                {{ $proyectos->total() }}

            </span>

            registros.

        </p>

        {{ $proyectos->links() }}

    </div>

</x-proyectos-layout>