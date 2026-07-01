<x-objetivos-layout title="Gestión de Objetivos Estratégicos">
    
    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
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
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Objetivos Institucionales
            </a>

        </div>

    </div>

    <div class="overflow-y-auto" style="height: calc(100vh - 280px);"> <!-- Scroll vertical -->

        <!-- Encabezado -->
        <div class="mb-8">

            <h2 class="text-2xl font-semibold text-gray-800">
                Objetivos Estratégicos
            </h2>

            <p class="mt-2 text-gray-600">
                Administre los Objetivos de Desarrollo Sostenible (ODS), los objetivos del Plan Nacional de Desarrollo (PND) y los Objetivos Estratégicos Institucionales (OEI).
            </p>

        </div>

        <!-- Tarjetas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tarjeta ODS -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            ODS
                        </h3>

                        <p class="text-sm text-gray-500">
                            Objetivos de Desarrollo Sostenible
                        </p>
                    </div>

                    <div class="bg-blue-100 rounded-full p-3">
                        <i class="bi bi-globe-americas text-2xl text-blue-600"></i>
                    </div>

                </div>

                <div class="mb-6">

                    <p class="text-4xl font-bold text-gray-800">
                        {{ $totalODS }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Objetivos registrados
                    </p>

                </div>

                <a href="{{ route('objetivos.ods') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">

                    Ver catálogo

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>

            <!-- Tarjeta PND -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            PND
                        </h3>

                        <p class="text-sm text-gray-500">
                            Plan Nacional de Desarrollo
                        </p>
                    </div>

                    <div class="bg-green-100 rounded-full p-3">
                        <i class="bi bi-diagram-3 text-2xl text-green-600"></i>
                    </div>

                </div>

                <div class="mb-6">

                    <p class="text-4xl font-bold text-gray-800">
                        {{ $totalPND }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Objetivos registrados
                    </p>

                </div>

                <a href="{{ route('objetivos.pnd') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">

                    Ver catálogo

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>

            <!-- Tarjeta OEI -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Objetivos Institucionales
                        </h3>

                        <p class="text-sm text-gray-500">
                            Objetivos creados por la institución
                        </p>
                    </div>

                    <div class="bg-purple-100 rounded-full p-3">
                        <i class="bi bi-bullseye text-2xl text-purple-600"></i>
                    </div>

                </div>

                <div class="mb-6">

                    <p class="text-4xl font-bold text-gray-800">
                        {{ $totalOEI }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Objetivos registrados
                    </p>

                </div>

                <a href="{{ route('objetivos.oei') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">

                    Ver catálogo

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

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

</x-objetivos-layout>