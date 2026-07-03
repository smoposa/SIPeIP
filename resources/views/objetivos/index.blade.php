<x-objetivos-layout title="Página de inicio">
    
    <!-- Barra de acciones
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('planes.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Inicio
            </a>

        </div>

    </div> -->

    <!-- Marco general del contenido -->
    <div class="space-y-6">

        <!-- Encabezado -->
        <div>

            <h2 class="text-2xl font-semibold text-gray-800">
                Información general
            </h2>

            <p class="mt-2 text-gray-600">
                Administre los objetivos estratégicos del sistema.
            </p>

        </div>

        <!-- Scroll vertical -->
        <div class="overflow-y-auto" style="height: calc(100vh - 220px);">

            <div class="space-y-6">

                <!-- Tarjetas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- ODS -->
                    <div class="bg-white border border-gray-200 rounded-lg p-5">

                        <h3 class="text-base font-semibold text-gray-800">
                            Objetivos de Desarrollo Sostenible
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            ODS
                        </p>

                        <p class="text-4xl font-semibold text-gray-700 mt-4">
                            {{ $totalODS }}
                        </p>

                    </div>

                    <!-- PND -->
                    <div class="bg-white border border-gray-200 rounded-lg p-5">

                        <h3 class="text-base font-semibold text-gray-800">
                            Objetivos Plan Nacional de Desarrollo
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            PND
                        </p>

                        <p class="text-4xl font-semibold text-gray-700 mt-4">
                            {{ $totalPND }}
                        </p>

                    </div>

                    <!-- OEI -->
                    <div class="bg-white border border-gray-200 rounded-lg p-5">

                        <h3 class="text-base font-semibold text-gray-800">
                            Objetivos Estratégicos Institucionales
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            OEI
                        </p>

                        <p class="text-4xl font-semibold text-gray-700 mt-4">
                            {{ $totalOEI }}
                        </p>

                    </div>

                </div>

                <!-- Información -->
                <div class="mt-10 bg-white border border-gray-200 rounded-lg p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Descripción del módulo
                    </h3>

                    <div class="space-y-5">

                        <div class="flex items-start">

                            <div class="mt-1">
                                <i class="bi bi-globe-americas text-blue-600 text-xl"></i>
                            </div>

                            <div class="ml-4">

                                <h4 class="font-medium text-gray-800">
                                    Objetivos de Desarrollo Sostenible (ODS)
                                </h4>

                                <p class="text-sm text-gray-600 mt-1">
                                    Catálogo oficial de los 17 Objetivos de Desarrollo Sostenible definidos por las Naciones Unidas. Su administración es centralizada y únicamente se actualiza cuando existen cambios oficiales.
                                </p>

                            </div>

                        </div>

                        <div class="border-t border-gray-200"></div>

                        <div class="flex items-start">

                            <div class="mt-1">
                                <i class="bi bi-diagram-3 text-green-600 text-xl"></i>
                            </div>

                            <div class="ml-4">

                                <h4 class="font-medium text-gray-800">
                                    Plan Nacional de Desarrollo (PND)
                                </h4>

                                <p class="text-sm text-gray-600 mt-1">
                                    Catálogo de objetivos establecidos en el Plan Nacional de Desarrollo vigente. Estos objetivos sirven como referencia para la alineación estratégica de las instituciones públicas.
                                </p>

                            </div>

                        </div>

                        <div class="border-t border-gray-200"></div>

                        <div class="flex items-start">

                            <div class="mt-1">
                                <i class="bi bi-bullseye text-purple-600 text-xl"></i>
                            </div>

                            <div class="ml-4">

                                <h4 class="font-medium text-gray-800">
                                    Objetivos Estratégicos Institucionales (OEI)
                                </h4>

                                <p class="text-sm text-gray-600 mt-1">
                                    Objetivos definidos por cada institución para contribuir al cumplimiento del Plan Nacional de Desarrollo y de los Objetivos de Desarrollo Sostenible mediante sus programas, proyectos y metas.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>     
        
    </div>

</x-objetivos-layout>