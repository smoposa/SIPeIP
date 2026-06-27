<x-plan-layout title="Página de inicio">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Planificación Institucional
        </h2>
    </x-slot>

    <!-- Marco general del contenido -->
    <div class="space-y-6">

        <!-- Encabezado -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">
                Información general
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Administre los Planes Estratégicos Institucionales (PEI) registrados en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
            </p>

        </div>

        <!-- Scroll vertical -->
        <div class="overflow-y-auto" style="height: calc(100vh - 210px);">

            <!-- Tarjetas Indicadores -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Registrados -->
                <div class="bg-white border border-gray-200 rounded-lg p-5">

                    <h3 class="text-base font-semibold text-gray-800">
                        Planes registrados
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Total de planes estratégicos institucionales
                    </p>

                    <p class="text-4xl font-semibold text-gray-700 mt-4">
                        {{ $totalPlanes }}
                    </p>

                </div>

                <!-- Activos -->
                <div class="bg-white border border-gray-200 rounded-lg p-5">

                    <h3 class="text-base font-semibold text-gray-800">
                        Planes activos
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Planes estratégicos vigentes
                    </p>

                    <p class="text-4xl font-semibold text-gray-700 mt-4">
                        {{ $planesActivos }}
                    </p>

                </div>

                <!-- Finalizados -->
                <div class="bg-white border border-gray-200 rounded-lg p-5">

                    <h3 class="text-base font-semibold text-gray-800">
                        Planes finalizados
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Históricos del sistema
                    </p>

                    <p class="text-4xl font-semibold text-gray-700 mt-4">
                        {{ $planesFinalizados }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-plan-layout>