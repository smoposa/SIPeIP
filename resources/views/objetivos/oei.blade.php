<x-objetivos-layout title="Objetivos Estratégicos Institucionales">

    <!-- Barra de acciones -->
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

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-2xl font-semibold text-gray-800">
                Objetivos Estratégicos Institucionales
            </h2>

            <p class="text-gray-600 mt-1">
                Administre los objetivos estratégicos definidos por la institución.
            </p>

        </div>

        <a href="#"
           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

            <i class="bi bi-plus-circle mr-2"></i>

            Registrar Objetivo

        </a>

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
                        Objetivo Estratégico
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
                                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 text-sm text-gray-700">
                        OEI-001
                    </td>

                    <td class="px-4 py-3">

                        <a href="{{ route('objetivos.detalle', 1) }}"
                           class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                            Fortalecer la gestión institucional mediante la modernización de los procesos administrativos.

                        </a>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Activo
                        </span>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <a href="#"
                           class="text-blue-600 hover:text-blue-800 mr-3">

                            <i class="bi bi-pencil-square"></i>

                        </a>

                        <button class="text-red-600 hover:text-red-800">

                            <i class="bi bi-trash"></i>

                        </button>

                    </td>

                </tr>

                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 text-sm text-gray-700">
                        OEI-002
                    </td>

                    <td class="px-4 py-3">

                        <a href="{{ route('objetivos.detalle', 2) }}"
                           class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                            Incrementar la eficiencia en la ejecución de programas y proyectos institucionales.

                        </a>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Activo
                        </span>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <a href="#"
                           class="text-blue-600 hover:text-blue-800 mr-3">

                            <i class="bi bi-pencil-square"></i>

                        </a>

                        <button class="text-red-600 hover:text-red-800">

                            <i class="bi bi-trash"></i>

                        </button>

                    </td>

                </tr>

                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 text-sm text-gray-700">
                        OEI-003
                    </td>

                    <td class="px-4 py-3">

                        <a href="{{ route('objetivos.detalle', 3) }}"
                           class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                            Promover la innovación tecnológica para mejorar los servicios institucionales.

                        </a>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Activo
                        </span>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <a href="#"
                           class="text-blue-600 hover:text-blue-800 mr-3">

                            <i class="bi bi-pencil-square"></i>

                        </a>

                        <button class="text-red-600 hover:text-red-800">

                            <i class="bi bi-trash"></i>

                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>
        <!-- Pie de tabla -->

    <div class="flex items-center justify-between mt-6">

        <p class="text-sm text-gray-600">
            Mostrando <span class="font-medium">3</span> registros.
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