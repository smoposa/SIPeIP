<x-objetivos-layout title="Gestión de Objetivos Estratégicos">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Información General
            </a>

            <a href="{{ route('objetivos.create') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear Objetivo
            </a>

            <a href="{{ route('objetivos.listar') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Consultar Objetivos
            </a>

        </div>

    </div>

    <!-- Encabezado -->
    <div class="mb-8">

        <h2 class="text-3xl font-bold text-gray-900">
            Gestión de Objetivos Estratégicos
        </h2>

        <p class="mt-2 text-gray-600">
            Administre los diferentes niveles de objetivos utilizados en el Sistema Integral
            de Planificación e Inversión Pública (SIPeIP).
        </p>

    </div>

    <!-- Tarjetas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ODS -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-xl font-semibold text-gray-800">
                        Objetivos ODS
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Objetivos de Desarrollo Sostenible de la ONU.
                    </p>

                </div>

                <i class="bi bi-globe-americas text-5xl text-blue-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold text-gray-800">
                    17
                </div>

                <div class="text-sm text-gray-500 mt-1">
                    Objetivos disponibles
                </div>

            </div>

            <div class="mt-8">

                <a href="{{ route('objetivos.listar') }}"
                   class="text-blue-600 hover:text-blue-800 hover:underline">

                    Administrar ODS →

                </a>

            </div>

        </div>

        <!-- PND -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-xl font-semibold text-gray-800">
                        Objetivos PND
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Objetivos del Plan Nacional de Desarrollo.
                    </p>

                </div>

                <i class="bi bi-diagram-3 text-5xl text-green-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold text-gray-800">
                    0
                </div>

                <div class="text-sm text-gray-500 mt-1">
                    Registrados
                </div>

            </div>

            <div class="mt-8 text-gray-400">

                Disponible en la siguiente fase.

            </div>

        </div>

        <!-- OEI -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-xl font-semibold text-gray-800">
                        Objetivos OEI
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Objetivos Estratégicos Institucionales.
                    </p>

                </div>

                <i class="bi bi-building text-5xl text-cyan-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold text-gray-800">
                    0
                </div>

                <div class="text-sm text-gray-500 mt-1">
                    Registrados
                </div>

            </div>

            <div class="mt-8 text-gray-400">

                Disponible en la siguiente fase.

            </div>

        </div>

    </div>

    <!-- Flujo -->
    <div class="mt-10 bg-white rounded-lg border border-gray-200 p-6">

        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Jerarquía de Objetivos
        </h3>

        <div class="flex flex-wrap items-center justify-center gap-4 text-center">

            <div class="px-5 py-3 bg-blue-50 border border-blue-200 rounded-lg">
                <strong>ODS</strong>
            </div>

            <i class="bi bi-arrow-right text-xl text-gray-500"></i>

            <div class="px-5 py-3 bg-green-50 border border-green-200 rounded-lg">
                <strong>PND</strong>
            </div>

            <i class="bi bi-arrow-right text-xl text-gray-500"></i>

            <div class="px-5 py-3 bg-cyan-50 border border-cyan-200 rounded-lg">
                <strong>OEI</strong>
            </div>

            <i class="bi bi-arrow-right text-xl text-gray-500"></i>

            <div class="px-5 py-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <strong>Metas</strong>
            </div>

            <i class="bi bi-arrow-right text-xl text-gray-500"></i>

            <div class="px-5 py-3 bg-purple-50 border border-purple-200 rounded-lg">
                <strong>Indicadores</strong>
            </div>

            <i class="bi bi-arrow-right text-xl text-gray-500"></i>

            <div class="px-5 py-3 bg-orange-50 border border-orange-200 rounded-lg">
                <strong>Programas</strong>
            </div>

            <i class="bi bi-arrow-right text-xl text-gray-500"></i>

            <div class="px-5 py-3 bg-red-50 border border-red-200 rounded-lg">
                <strong>Proyectos</strong>
            </div>

        </div>

    </div>

</x-objetivos-layout>