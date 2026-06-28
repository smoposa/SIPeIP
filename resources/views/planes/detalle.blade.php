<x-planes-layout title="Detalle del Plan Institucional">

    <!-- Barra de acciones -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('planes.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
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

            <a href="{{ route('planes.detalle', $plan->id) }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Detalle del Plan
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h2 class="text-3xl font-semibold text-gray-800">

                {{ $plan->nombre }}

            </h2>

            <p class="mt-2 text-gray-600">

                Información general del plan institucional.

            </p>

        </div>

        <a href="{{ route('planes.edit', $plan->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">

            <i class="bi bi-pencil-square me-2"></i>

            Editar

        </a>

    </div>

    <!-- Información -->

    <div class="bg-white border rounded-lg shadow-sm">

        <div class="px-8 py-6 border-b border-gray-200">

            <h3 class="text-xl font-semibold text-gray-800">

                Datos Generales

            </h3>

        </div>

        <div class="p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Código -->

                <div>

                    <h5 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">

                        Código del Plan

                    </h5>

                    <p class="mt-2 text-gray-800">

                        {{ $plan->codigo }}

                    </p>

                </div>

                <!-- Nombre -->

                <div>

                    <h5 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">

                        Nombre del Plan

                    </h5>

                    <p class="mt-2 text-gray-800">

                        {{ $plan->nombre }}

                    </p>

                </div>

                <!-- Tipo -->

                <div>

                    <h5 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">

                        Tipo de Plan

                    </h5>

                    <p class="mt-2 text-gray-800">

                        {{ $plan->tipo }}

                    </p>

                </div>

                <!-- Fecha Inicio -->

                <div>

                    <h5 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">

                        Fecha de Inicio

                    </h5>

                    <p class="mt-2 text-gray-800">

                        {{ $plan->fecha_inicio }}

                    </p>

                </div>

                <!-- Fecha Fin -->

                <div>

                    <h5 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">

                        Fecha de Finalización

                    </h5>

                    <p class="mt-2 text-gray-800">

                        {{ $plan->fecha_fin }}

                    </p>

                </div>

                <!-- Estado -->

                <div>

                    <h5 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">

                        Estado

                    </h5>

                    <p class="mt-2">

                        @if($plan->estado == 'Activo')

                            <span class="inline-flex px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">

                                Activo

                            </span>

                        @else

                            <span class="inline-flex px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">

                                Inactivo

                            </span>

                        @endif

                    </p>

                </div>

            </div>

            <!-- Descripción -->

            <div class="mt-10">

                <h5 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">

                    Descripción

                </h5>

                <p class="mt-3 text-gray-700 leading-relaxed">

                    {{ $plan->descripcion }}

                </p>

            </div>
                    </div>

        <!-- Pie -->

        <div class="px-8 py-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">

            <div class="flex justify-between items-center">

                <a href="{{ route('planes.listar') }}"
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">

                    <i class="bi bi-arrow-left me-2"></i>

                    Volver

                </a>

                <a href="{{ route('planes.edit', $plan->id) }}"
                   class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                    <i class="bi bi-pencil-square me-2"></i>

                    Editar Plan

                </a>

            </div>

        </div>

    </div>

</x-planes-layout>