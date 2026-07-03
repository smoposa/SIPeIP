<x-planes-layout title="Página de inicio">

    <!-- Barra de acciones 
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('planes.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Inicio
            </a>

        </div>

    </div>-->

    <!-- Marco general del contenido -->
    <div class="space-y-6">

        <!-- Encabezado -->
          <div>

            <h2 class="text-2xl font-semibold text-gray-900">
                Gestión de Planes
            </h2>

            <p class="mt-2 text-gray-600">
                Administre los planes institucionales que servirán de base para la planificación estratégica y la inversión pública.
            </p>
        </div>

        <!-- Scroll vertical -->
        <div class="overflow-y-auto" style="height: calc(100vh - 280px);">

            <div class="space-y-6">

                <!-- Información adicional -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">

                    <div class="flex items-start">

                        <i class="bi bi-info-circle-fill text-blue-600 text-2xl mr-4"></i>

                        <div>

                            <h4 class="text-lg font-semibold text-blue-900">
                                Importante
                            </h4>

                            <p class="mt-2 text-sm text-blue-800 leading-relaxed">

                                Todo plan institucional constituye la base para la planificación
                                estratégica de la entidad. Una correcta definición del plan
                                permitirá establecer objetivos claros, generar la matriz de
                                alineación y registrar posteriormente los proyectos de inversión,
                                metas e indicadores que conforman el proceso integral de
                                planificación del SIPeIP.

                            </p>

                        </div>

                    </div>

                </div>

                <!-- Tarjetas Indicadores -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Planes Registrados -->
                    <div class="bg-white border border-gray-200 rounded-lg p-5">

                        <h3 class="text-base font-semibold text-gray-800">
                            Planes Registrados
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Total de planes registrados
                        </p>

                        <p class="text-4xl font-semibold text-gray-700 mt-4">
                            {{ $totalPlanes }}
                        </p>

                    </div>

                    <!-- Planes Activos -->
                    <div class="bg-white border border-gray-200 rounded-lg p-5">

                        <h3 class="text-base font-semibold text-gray-800">
                            Planes Activos
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Planes vigentes en el sistema
                        </p>

                        <p class="text-4xl font-semibold text-gray-700 mt-4">
                            {{ $planesActivos }}
                        </p>

                    </div>

                    <!-- Planes Inactivos -->
                    <div class="bg-white border border-gray-200 rounded-lg p-5">

                        <h3 class="text-base font-semibold text-gray-800">
                            Planes Inactivos
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Planes deshabilitados
                        </p>

                        <p class="text-4xl font-semibold text-gray-700 mt-4">
                            {{ $planesInactivos }}
                        </p>

                    </div>

                </div>

                <!-- Accesos rápidos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Objetivos Estratégicos -->
                    <div class="bg-white border rounded-xl p-6">

                        <i class="bi bi-bullseye text-4xl text-orange-500"></i>

                        <h3 class="mt-4 text-lg font-semibold">
                            Objetivos Estratégicos
                        </h3>

                        <p class="text-sm text-gray-600 mt-2">

                            Los planes institucionales servirán posteriormente para
                            relacionarse con los Objetivos de Desarrollo Sostenible (ODS),
                            el Plan Nacional de Desarrollo (PND) y los Objetivos
                            Estratégicos Institucionales (OEI).

                        </p>

                    </div>

                    <!-- Proyectos -->
                    <div class="bg-white border rounded-xl p-6">

                        <i class="bi bi-diagram-3 text-4xl text-purple-600"></i>

                        <h3 class="mt-4 text-lg font-semibold">
                            Proyectos de Inversión
                        </h3>

                        <p class="text-sm text-gray-600 mt-2">

                            Una vez definido un plan y su alineación estratégica,
                            podrán registrarse los proyectos institucionales.

                        </p>

                    </div>

                </div>
                                <!-- Flujo de planificación -->
                <div class="bg-white border rounded-xl p-8">

                    <h3 class="text-xl font-semibold text-gray-800 mb-8">
                        Flujo General de Planificación
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-9 gap-4 items-center text-center">

                        <!-- Plan -->
                        <div>

                            <div class="w-16 h-16 mx-auto rounded-full bg-blue-100 flex items-center justify-center">

                                <i class="bi bi-file-earmark-text text-3xl text-blue-600"></i>

                            </div>

                            <p class="mt-3 font-medium">
                                Plan
                            </p>

                        </div>

                        <!-- Flecha -->
                        <div class="flex items-center justify-center">

                            <i class="bi bi-arrow-right text-3xl text-gray-400"></i>

                        </div>

                        <!-- Objetivos -->
                        <div>

                            <div class="w-16 h-16 mx-auto rounded-full bg-orange-100 flex items-center justify-center">

                                <i class="bi bi-bullseye text-3xl text-orange-500"></i>

                            </div>

                            <p class="mt-3 font-medium">
                                Objetivos
                            </p>

                        </div>

                        <!-- Flecha -->
                        <div class="flex items-center justify-center">

                            <i class="bi bi-arrow-right text-3xl text-gray-400"></i>

                        </div>

                        <!-- Alineación -->
                        <div>

                            <div class="w-16 h-16 mx-auto rounded-full bg-green-100 flex items-center justify-center">

                                <i class="bi bi-diagram-2 text-3xl text-green-600"></i>

                            </div>

                            <p class="mt-3 font-medium">
                                Alineación
                            </p>

                        </div>

                        <!-- Flecha -->
                        <div class="flex items-center justify-center">

                            <i class="bi bi-arrow-right text-3xl text-gray-400"></i>

                        </div>

                        <!-- Proyectos -->
                        <div>

                            <div class="w-16 h-16 mx-auto rounded-full bg-purple-100 flex items-center justify-center">

                                <i class="bi bi-kanban text-3xl text-purple-600"></i>

                            </div>

                            <p class="mt-3 font-medium">
                                Proyectos
                            </p>

                        </div>

                        <!-- Flecha -->
                        <div class="flex items-center justify-center">

                            <i class="bi bi-arrow-right text-3xl text-gray-400"></i>

                        </div>

                        <!-- Metas e Indicadores -->
                        <div>

                            <div class="w-16 h-16 mx-auto rounded-full bg-cyan-100 flex items-center justify-center">

                                <i class="bi bi-bar-chart-line text-3xl text-cyan-600"></i>

                            </div>

                            <p class="mt-3 font-medium">
                                Metas e Indicadores
                            </p>

                        </div>

                    </div>

                </div>
                            </div> <!-- Fin space-y-8 -->

        </div> <!-- Fin Scroll vertical -->

    </div> <!-- Fin Marco general del contenido -->

</x-planes-layout>