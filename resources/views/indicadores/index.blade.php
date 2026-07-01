<x-objetivos-layout title="Indicadores de la Meta">

    <!-- Barra principal -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('objetivos.ods') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                ODS
            </a>

            <a href="{{ route('objetivos.pnd') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                PND
            </a>

            <a href="{{ route('objetivos.oei') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Objetivos Institucionales
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="flex items-start justify-between mb-6">

        <div>

            <div class="flex items-center gap-3">

                <a href="{{ route('metas.detalle', $meta->id) }}"
                   class="text-gray-500 hover:text-blue-600">

                    <i class="bi bi-arrow-left text-lg"></i>

                </a>

                <div>

                    <h2 class="text-2xl font-semibold text-gray-800">

                        {{ $meta->nombre }}

                    </h2>

                    <p class="text-gray-500 mt-1">

                        {{ $meta->codigo }}

                    </p>

                </div>

            </div>

        </div>

        <a href="{{ route('indicadores.create', $meta->id) }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

            <i class="bi bi-plus-circle mr-2"></i>

            Nuevo Indicador

        </a>

    </div>

    <!-- Barra de navegación -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('metas.detalle', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('indicadores.index', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Indicadores
            </a>

            <a href="{{ route('metas.seguimiento', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Seguimiento
            </a>

            <a href="{{ route('metas.presupuesto', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Presupuesto
            </a>

            <a href="{{ route('metas.historial', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Historial
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
                        Indicador
                    </th>

                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-600">
                        Meta
                    </th>

                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-600">
                        Estado
                    </th>

                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-600">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-200">
                                @forelse($indicadores as $indicador)

                    <tr class="hover:bg-gray-50">

                        <td class="px-4 py-3 text-sm text-gray-700">

                            {{ $indicador->codigo }}

                        </td>

                        <td class="px-4 py-3">

                            <a href="{{ route('indicadores.detalle', $indicador->id) }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                                {{ $indicador->nombre }}

                            </a>

                        </td>

                        <td class="px-4 py-3 text-center text-sm text-gray-700">

                            {{ $indicador->meta }}

                            @if($indicador->unidad_medida)

                                {{ $indicador->unidad_medida }}

                            @endif

                        </td>

                        <td class="px-4 py-3 text-center">

                            @if($indicador->estado == 'Activo')

                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">

                                    Activo

                                </span>

                            @else

                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">

                                    Inactivo

                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3 text-center">

                            <a href="{{ route('indicadores.edit', $indicador->id) }}"
                               class="text-blue-600 hover:text-blue-800 mr-3">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">

                            <i class="bi bi-inbox text-4xl block mb-3"></i>

                            No existen indicadores registrados para esta meta.

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

                {{ $indicadores->count() }}

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