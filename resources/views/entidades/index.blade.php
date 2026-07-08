<x-entidades-layout title="Página de inicio">

    <!-- Barra de acciones
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">
            <a href="{{ route('entidades.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Inicio
            </a>
        </div>
    </div> -->

     <!-- Marco general del contenido -->
    <div class="space-y-6">

        <!-- Encabezado -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">
                Información general
            </h2>

            <p class="mt-2 text-gray-600">
                Administre las entidades públicas registradas en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
            </p>

        </div>

        <!-- Scroll vertical -->
        <div class="overflow-y-auto" style="height: calc(100vh - 220px);">

            <div class="space-y-6">

            <!-- Tarjetas Indicadores -->
            <div class="bg-white border border-gray-200 rounded-lg">

                <div class="grid grid-cols-1 lg:grid-cols-2">

                    <!-- Indicadores -->
                    <div class="p-8 border-r border-gray-200">

                        <h3 class="text-lg font-semibold text-gray-800 mb-6">
                            Resumen General
                        </h3>

                        <div class="space-y-6">

                            <div class="flex justify-between items-center">

                                <span class="text-gray-600">
                                    Entidades registradas
                                </span>

                                <span class="text-2xl font-semibold text-gray-800">
                                    {{ $totalEntidades }}
                                </span>

                            </div>

                            <div class="flex justify-between items-center">

                                <span class="text-gray-600">
                                    Entidades activas
                                </span>

                                <span class="text-2xl font-semibold text-green-600">
                                    {{ $entidadesActivas }}
                                </span>

                            </div>

                            <div class="flex justify-between items-center">

                                <span class="text-gray-600">
                                    Entidades inactivas
                                </span>

                                <span class="text-2xl font-semibold text-red-500">
                                    {{ $entidadesInactivas }}
                                </span>

                            </div>

                        </div>

                    </div>

                    <!-- Distribución -->
                    <div class="p-8">

                        <h3 class="text-lg font-semibold text-gray-800 mb-6">
                            Distribución por tipo
                        </h3>

                        <div class="space-y-5">

                            <div class="flex justify-between border-b pb-2">

                                <span>Secretarías</span>

                                <span class="font-semibold">
                                    {{ $totalSecretarias }}
                                </span>

                            </div>

                            <div class="flex justify-between border-b pb-2">

                                <span>Ministerios</span>

                                <span class="font-semibold">
                                    {{ $totalMinisterios }}
                                </span>

                            </div>

                            <div class="flex justify-between border-b pb-2">

                                <span>GAD Provinciales</span>

                                <span class="font-semibold">
                                    {{ $totalGadProvinciales }}
                                </span>

                            </div>

                            <div class="flex justify-between border-b pb-2">

                                <span>GAD Municipales</span>

                                <span class="font-semibold">
                                    {{ $totalGadMunicipales }}
                                </span>

                            </div>

                            <div class="flex justify-between">

                                <span>GAD Parroquiales</span>

                                <span class="font-semibold">
                                    {{ $totalGadParroquiales }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</x-entidades-layout>