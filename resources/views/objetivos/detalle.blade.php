<x-objetivos-layout title="Detalle del Objetivo Estratégico">

    <!-- Barra de navegación -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.detalle', 1) }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Información General
            </a>

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Alineación
            </a>

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Metas
            </a>

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Proyectos
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="flex items-center justify-between mb-8">

        <div>

            <h2 class="text-2xl font-semibold text-gray-800">
                Objetivo Estratégico Institucional
            </h2>

            <p class="text-gray-600 mt-1">
                Información general del objetivo estratégico.
            </p>

        </div>

        <a href="#"
           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

            <i class="bi bi-pencil-square mr-2"></i>

            Editar

        </a>

    </div>

    <!-- Información -->

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

        <table class="min-w-full">

            <tbody class="divide-y divide-gray-200">

                <tr>

                    <td class="w-64 px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Código
                    </td>

                    <td class="px-6 py-4">
                        OEI-001
                    </td>

                </tr>

                <tr>

                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Nombre
                    </td>

                    <td class="px-6 py-4">
                        Fortalecer la gestión institucional mediante la modernización de los procesos administrativos.
                    </td>

                </tr>

                <tr>

                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Descripción
                    </td>

                    <td class="px-6 py-4">
                        Objetivo orientado a mejorar la eficiencia institucional mediante la optimización de procesos, incorporación de tecnologías y fortalecimiento de la gestión pública.
                    </td>

                </tr>
                                <tr>

                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Responsable
                    </td>

                    <td class="px-6 py-4">
                        Dirección de Planificación Institucional
                    </td>

                </tr>

                <tr>

                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Fecha de Inicio
                    </td>

                    <td class="px-6 py-4">
                        01/01/2026
                    </td>

                </tr>

                <tr>

                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Fecha de Fin
                    </td>

                    <td class="px-6 py-4">
                        31/12/2029
                    </td>

                </tr>

                <tr>

                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Estado
                    </td>

                    <td class="px-6 py-4">

                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Activo
                        </span>

                    </td>

                </tr>

                <tr>

                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Fecha de Creación
                    </td>

                    <td class="px-6 py-4">
                        15/01/2026
                    </td>

                </tr>

                <tr>

                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">
                        Última Actualización
                    </td>

                    <td class="px-6 py-4">
                        20/03/2026
                    </td>

                </tr>

            </tbody>

        </table>

    </div>
        <!-- Botón volver -->

    <div class="mt-6 flex justify-end">

        <a href="{{ route('objetivos.oei') }}"
           class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 rounded-lg">

            <i class="bi bi-arrow-left mr-2"></i>

            Volver a Objetivos Institucionales

        </a>

    </div>

</x-objetivos-layout>
