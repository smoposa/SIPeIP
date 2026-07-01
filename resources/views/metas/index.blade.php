<x-objetivos-layout title="Metas del Objetivo">

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

                <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                   class="text-gray-500 hover:text-blue-600">

                    <i class="bi bi-arrow-left text-lg"></i>

                </a>

                <div>

                    <h2 class="text-2xl font-semibold text-gray-800">

                        {{ $objetivo->nombre }}

                    </h2>

                    <p class="text-gray-500 mt-1">

                        {{ $objetivo->codigo }}

                    </p>

                </div>

            </div>

        </div>

        <a href="{{ route('metas.create', $objetivo->id) }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

            <i class="bi bi-plus-circle mr-2"></i>

            Nueva Meta

        </a>

    </div>

    <!-- Barra del Objetivo -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('metas.index', $objetivo->id) }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Metas
            </a>

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Proyectos
            </a>

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Alineación
            </a>

            <a href="#"
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
                        Meta
                    </th>

                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-600">
                        Valor
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

                        <td class="px-4 py-3 text-center">

                            <a href="{{ route('metas.edit', $meta->id) }}"
                               class="text-blue-600 hover:text-blue-800 mr-3">

                                <i class="bi bi-pencil-square"></i>

                            </a>

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