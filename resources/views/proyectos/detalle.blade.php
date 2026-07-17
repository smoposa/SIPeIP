<x-proyectos-layout title="Detalle del Proyecto">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('proyectos.listar') }}"
                class="py-2 text-sm font-medium text-blue-600 hover:text-green-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

            <a href="{{ route('proyectos.detalle', $proyecto->id) }}"
                class="{{ request()->routeIs('proyectos.detalle')
                    ? 'px-3 py-2 text-sm text-green-700 bg-gray-100 transition'
                    : 'px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition' }}">

                <i class="bi bi-info-circle text-green-600 me-2"></i>

                Información General

            </a>

            <a href="#"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-graph-up-arrow text-green-600 me-2"></i>

                Seguimiento

            </a>

            <a href="#"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-clock-history text-green-600 me-2"></i>

                Historial

            </a>

            <a href="{{ url()->current() }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-arrow-clockwise text-green-600 me-2"></i>

                Actualizar

            </a>

        </div>

    </div>

    <!-- Scroll -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <div class="bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            <div class="flex items-center gap-4 mb-0 pb-6">

                <div class="w-16 h-16 rounded-full bg-[#16A34A]
                            flex items-center justify-center
                            text-white text-3xl">

                    <i class="bi bi-building"></i>

                </div>

                <div>

                    <h2 class="text-xl font-semibold text-gray-800">

                        {{ $proyecto->nombre }}

                    </h2>

                    <p class="text-gray-500">

                        {{ $proyecto->codigo }}

                    </p>

                </div>

            </div>

            <!-- Información General -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="flex justify-between items-center px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">

                        Información general

                    </h4>

                    <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                        class="text-sm text-blue-600 hover:text-blue-800">

                        Editar

                    </a>

                </div>

            </div>

            <!-- Datos -->
            <div class="px-4 py-3">

                <div class="space-y-4 mb-6">
                                    <!-- Código -->
                <div class="flex">

                    <span class="w-44 text-sm font-semibold text-gray-700">
                        Código
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $proyecto->codigo }}
                    </span>

                </div>

                <!-- Programa -->
                <div class="flex">

                    <span class="w-44 text-sm font-semibold text-gray-700">
                        Programa
                    </span>

                    <span class="text-sm text-gray-600">

                        {{ $proyecto->programa->codigo }}
                        -
                        {{ $proyecto->programa->nombre }}

                    </span>

                </div>

                <!-- Nombre -->
                <div class="flex">

                    <span class="w-44 text-sm font-semibold text-gray-700">
                        Nombre
                    </span>

                    <span class="text-sm font-medium text-[#16A34A]">
                        {{ $proyecto->nombre }}
                    </span>

                </div>

                <!-- Descripción -->
                <div class="flex items-start">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Descripción
                    </span>

                    <span class="text-sm text-gray-600 leading-relaxed">
                        {{ $proyecto->descripcion ?: 'No registra' }}
                    </span>

                </div>

                <!-- Fecha inicio -->
                <div class="flex">

                    <span class="w-44 text-sm font-semibold text-gray-700">
                        Fecha de inicio
                    </span>

                    <span class="text-sm text-gray-600">

                        {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}

                    </span>

                </div>

                <!-- Fecha fin -->
                <div class="flex">

                    <span class="w-44 text-sm font-semibold text-gray-700">
                        Fecha de finalización
                    </span>

                    <span class="text-sm text-gray-600">

                        {{ \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d/m/Y') }}

                    </span>

                </div>

                <!-- Presupuesto -->
                <div class="flex">

                    <span class="w-44 text-sm font-semibold text-gray-700">
                        Presupuesto aprobado
                    </span>

                    <span class="text-sm text-gray-600">

                        USD {{ number_format($proyecto->presupuesto_aprobado, 2) }}

                    </span>

                </div>

                <!-- Responsable -->
                <div class="flex">

                    <span class="w-44 text-sm font-semibold text-gray-700">
                        Responsable
                    </span>

                    <span class="text-sm text-gray-600">

                        {{ $proyecto->responsable->nombres }}
                        {{ $proyecto->responsable->apellidos }}

                        @if($proyecto->responsable->cargo)

                            - {{ $proyecto->responsable->cargo }}

                        @endif

                    </span>

                </div>

                <!-- Registrado por -->
                <div class="flex">

                    <span class="w-44 text-sm font-semibold text-gray-700">
                        Registrado por
                    </span>

                    <span class="text-sm text-gray-600">

                        {{ $proyecto->usuario->nombres }}
                        {{ $proyecto->usuario->apellidos }}

                    </span>

                </div>

            </div>

        </div>

        <!-- Estado -->
        <div class="bg-gray-100 border-b border-gray-200">

            <div class="px-4 py-2">

                <h4 class="text-sm font-semibold text-gray-800">
                    Estado del proyecto
                </h4>

            </div>

        </div>

        <div class="px-4 py-2">

            <div class="flex items-center mb-4">

                <span class="w-40 text-sm font-semibold text-gray-700">
                    Estado
                </span>

                @switch($proyecto->estado)

                    @case('Planificado')

                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                            Planificado
                        </span>

                        @break

                    @case('En ejecución')

                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            En ejecución
                        </span>

                        @break

                    @case('Finalizado')

                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Finalizado
                        </span>

                        @break

                    @default

                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                            Suspendido
                        </span>

                @endswitch

                <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                    class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">

                    Editar

                </a>

            </div>

        </div>

        <!-- Auditoría -->
        <div class="bg-gray-100 border-b border-gray-200">

            <div class="px-4 py-2">

                <h4 class="text-sm font-semibold text-gray-800">
                    Auditoría
                </h4>

            </div>

        </div>

        <div class="px-4 py-2">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <p class="text-sm font-semibold text-gray-700">
                        Fecha de creación
                    </p>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ $proyecto->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                    </p>

                </div>

                <div>

                    <p class="text-sm font-semibold text-gray-700">
                        Última actualización
                    </p>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ $proyecto->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</x-proyectos-layout>