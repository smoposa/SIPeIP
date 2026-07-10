<x-objetivos-layout title="Metas del Objetivo">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">


            <a href="{{ route('metas.index', $objetivo->id) }}"
            class="{{ request()->routeIs('metas.*')
                    ? 'px-3 py-2 text-sm text-green-700 bg-gray-100 transition'
                    : 'px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition' }}">

                <i class="bi bi-bullseye text-green-600 me-2"></i>

                Metas

            </a>

            <a href="#"
            class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-folder2-open text-green-600 me-2"></i>

                Proyectos

            </a>

            <a href="#"
            class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-diagram-3 text-green-600 me-2"></i>

                Alineación

            </a>

            <a href="#"
            class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-clock-history text-green-600 me-2"></i>

                Historial

            </a>

            <a href="{{ url()->current() }}"
            class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-arrow-clockwise text-green-600 me-2"></i>

                Actualizar

            </a>

        </div>

    </div>

    <!-- Scroll -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <div class="bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            <div class="flex items-center gap-4 mb-0 pb-2">

                <div class="w-16 h-16 rounded-full bg-[#16A34A]
                            flex items-center justify-center
                            text-white text-3xl">

                    <i class="bi bi-bullseye"></i>

                </div>

                <div>

                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $objetivo->nombre }}
                    </h2>

                    <p class="text-gray-500">
                        {{ $objetivo->codigo }}
                    </p>

                </div>

            </div>

            <!-- Barra de navegación -->
            <div class="bg-white mb-6">

                <div class="flex items-center">

                    <a href="{{ route('metas.index', $objetivo->id) }}"
                    class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                        Inicio
                    </a>

                    <a href="#"
                    class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-blue-700">
                        Buscar
                    </a>

                    <a href="#"
                    class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-blue-700">
                        Reportes
                    </a>

                    <a href="#"
                    class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-blue-700">
                        Estadísticas
                    </a>

                    <span class="mx-3 text-gray-300">|</span>

                    <a href="{{ route('metas.create', $objetivo->id) }}"
                    class="px-5 py-3 text-sm font-medium text-blue-600 hover:text-blue-800">

                        <i class="bi bi-pencil-square me-2"></i>

                        Registrar Meta

                    </a>

                </div>

            </div>
            
            <!-- Tabla -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

                <table class="min-w-full">

                    <thead class="bg-gray-50 border-b border-gray-200">

                        <tr>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">
                                Código
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">
                                Meta
                            </th>

                            <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-600">
                                Valor
                            </th>

                            <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-600">
                                Estado
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">
                                        @forelse($metas as $meta)

                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3 text-sm text-gray-700">

                                    {{ $meta->codigo }}

                                </td>

                                <td class="px-4 py-3">

                                    <a href="{{ route('metas.detalle', $meta->id) }}"
                                    class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                                        {{ $meta->nombre }}

                                    </a>

                                </td>

                                <td class="px-4 py-3 text-center text-sm text-gray-700">

                                    {{ $meta->valor_meta ?? '-' }}

                                    @if($meta->unidad_medida)

                                        {{ $meta->unidad_medida }}

                                    @endif

                                </td>

                                <td class="px-4 py-3 text-center">

                                    @if($meta->estado == 'Activo')

                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">

                                            Activo

                                        </span>

                                    @else

                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">

                                            Inactivo

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">

                                    <i class="bi bi-inbox text-4xl block mb-3"></i>

                                    No existen metas registradas para este objetivo.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pie de tabla -->
            <div class="flex items-center justify-between mt-6">

                <p class="text-sm text-gray-600">

                    Mostrando
                    <span class="font-medium">

                        {{ $metas->count() }}

                    </span>

                    registros.

                </p>

                <!-- Paginación (Temporal) -->

                <div class="flex items-center space-x-2">

                    <button
                        class="px-3 py-1 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">

                        Anterior

                    </button>

                    <button
                        class="px-3 py-1 bg-blue-600 text-white rounded-md">

                        1

                    </button>

                    <button
                        class="px-3 py-1 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">

                        Siguiente

                    </button>

                </div>

            </div>

</x-objetivos-layout>