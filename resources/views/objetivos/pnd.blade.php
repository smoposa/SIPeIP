<x-objetivos-layout title="Plan Nacional de Desarrollo">

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
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                PND
            </a>

            <a href="{{ route('objetivos.oei') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Objetivos Institucionales
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-2xl font-semibold text-gray-800">
                Plan Nacional de Desarrollo
            </h2>

            <p class="text-gray-600 mt-1">
                Catálogo oficial de los objetivos del Plan Nacional de Desarrollo.
            </p>

        </div>

        <a href="#"
           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

            <i class="bi bi-plus-circle mr-2"></i>

            Registrar Objetivo PND

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
                        Nombre
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
                        PND-01
                    </td>

                    <td class="px-4 py-3">

                        <a href="#"
                           class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                            Incrementar y fomentar, de manera inclusiva, las oportunidades de empleo y las condiciones laborales.

                        </a>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Activo
                        </span>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <button class="text-blue-600 hover:text-blue-800 mr-3">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <button class="text-red-600 hover:text-red-800">
                            <i class="bi bi-trash"></i>
                        </button>

                    </td>

                </tr>

                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 text-sm text-gray-700">
                        PND-02
                    </td>

                    <td class="px-4 py-3">

                        <a href="#"
                           class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                            Garantizar el acceso equitativo y permanente a servicios de salud y educación de calidad.

                        </a>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Activo
                        </span>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <button class="text-blue-600 hover:text-blue-800 mr-3">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <button class="text-red-600 hover:text-red-800">
                            <i class="bi bi-trash"></i>
                        </button>

                    </td>

                </tr>

                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 text-sm text-gray-700">
                        PND-03
                    </td>

                    <td class="px-4 py-3">

                        <a href="#"
                           class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                            Impulsar el desarrollo sostenible mediante una gestión eficiente de los recursos públicos.

                        </a>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Activo
                        </span>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <button class="text-blue-600 hover:text-blue-800 mr-3">
                            <i class="bi bi-pencil-square"></i>
                        </button>

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