<x-planes-layout title="Gestión de Planes Institucionales">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('planes.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Información General
            </a>

            <a href="{{ route('planes.create') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear Plan
            </a>

            <a href="{{ route('planes.listar') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Consultar Planes
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="mb-8">

        <h2 class="text-3xl font-semibold text-gray-800">

            Gestión de Planes

        </h2>

        <p class="mt-2 text-gray-600 max-w-4xl leading-relaxed">

            Este módulo permite administrar los planes institucionales de las entidades públicas.
            Desde aquí se registran, consultan y administran los planes que servirán como base
            para la definición de objetivos estratégicos, la alineación institucional y la
            planificación de proyectos de inversión.

        </p>

    </div>

    <!-- Accesos rápidos -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <a href="{{ route('planes.create') }}"
           class="bg-white border rounded-xl p-6 hover:shadow-md transition">

            <i class="bi bi-file-earmark-plus text-4xl text-blue-600"></i>

            <h3 class="mt-4 text-lg font-semibold">

                Crear Plan

            </h3>

            <p class="text-sm text-gray-600 mt-2">

                Registrar un nuevo plan institucional.

            </p>

        </a>

        <a href="{{ route('planes.listar') }}"
           class="bg-white border rounded-xl p-6 hover:shadow-md transition">

            <i class="bi bi-list-ul text-4xl text-green-600"></i>

            <h3 class="mt-4 text-lg font-semibold">

                Consultar Planes

            </h3>

            <p class="text-sm text-gray-600 mt-2">

                Visualizar todos los planes registrados.

            </p>

        </a>
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

    <div class="bg-white border rounded-xl p-8 mb-8">

        <h3 class="text-xl font-semibold text-gray-800 mb-6">

            Flujo General de Planificación

        </h3>

        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 text-center">

            <div>

                <div class="w-16 h-16 mx-auto rounded-full bg-blue-100 flex items-center justify-center">

                    <i class="bi bi-file-earmark-text text-3xl text-blue-600"></i>

                </div>

                <p class="mt-3 font-medium">

                    Plan

                </p>

            </div>

            <div class="flex items-center justify-center">

                <i class="bi bi-arrow-right text-3xl text-gray-400"></i>

            </div>

            <div>

                <div class="w-16 h-16 mx-auto rounded-full bg-orange-100 flex items-center justify-center">

                    <i class="bi bi-bullseye text-3xl text-orange-500"></i>

                </div>

                <p class="mt-3 font-medium">

                    Objetivos

                </p>

            </div>

            <div class="flex items-center justify-center">

                <i class="bi bi-arrow-right text-3xl text-gray-400"></i>

            </div>

            <div>

                <div class="w-16 h-16 mx-auto rounded-full bg-green-100 flex items-center justify-center">

                    <i class="bi bi-diagram-2 text-3xl text-green-600"></i>

                </div>

                <p class="mt-3 font-medium">

                    Alineación

                </p>

            </div>

            <div class="flex items-center justify-center">

                <i class="bi bi-arrow-right text-3xl text-gray-400"></i>

            </div>
                        <div>

                <div class="w-16 h-16 mx-auto rounded-full bg-purple-100 flex items-center justify-center">

                    <i class="bi bi-kanban text-3xl text-purple-600"></i>

                </div>

                <p class="mt-3 font-medium">

                    Proyectos

                </p>

            </div>

            <div class="flex items-center justify-center">

                <i class="bi bi-arrow-right text-3xl text-gray-400"></i>

            </div>

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

</x-planes-layout>