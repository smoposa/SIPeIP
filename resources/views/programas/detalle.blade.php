<x-programas-layout title="Detalle del Programa">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('programas.listar') }}"
                class="py-2 text-sm font-medium text-blue-600 hover:text-green-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

            <a href="{{ route('programas.detalle', $programa->id) }}"
                class="{{ request()->routeIs('programas.detalle')
                    ? 'px-3 py-2 text-sm text-green-700 bg-gray-100 transition'
                    : 'px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition' }}">

                <i class="bi bi-info-circle text-green-600 me-2"></i>

                Información General

            </a>

            <a href="#"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-folder2-open text-green-600 me-2"></i>

                Proyectos

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

                    <i class="bi bi-diagram-3"></i>

                </div>

                <div>

                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $programa->nombre }}
                    </h2>

                    <p class="text-gray-500">
                        {{ $programa->codigo }}
                    </p>

                </div>

            </div>

            <!-- Información General -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="flex justify-between items-center px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    <a href="{{ route('programas.edit', $programa->id) }}"
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
                            {{ $programa->codigo }}
                        </span>

                    </div>

                    <!-- Nombre -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>

                        <span class="text-sm font-medium text-[#16A34A]">
                            {{ $programa->nombre }}
                        </span>

                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Descripción
                        </span>

                        <span class="text-sm text-gray-600 leading-relaxed">
                            {{ $programa->descripcion ?: 'No registra' }}
                        </span>

                    </div>

                    <!-- Período -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Período
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $programa->periodo_inicio }}
                            -
                            {{ $programa->periodo_fin }}
                        </span>

                    </div>

                    <!-- Responsable -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Responsable
                        </span>

                        <span class="text-sm text-gray-600">

                            {{ $programa->responsable->nombres }}
                            {{ $programa->responsable->apellidos }}

                            @if($programa->responsable->cargo)

                                - {{ $programa->responsable->cargo }}

                            @endif

                        </span>

                    </div>

                    <!-- Objetivos -->
                    <div class="flex items-start">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Objetivos asociados
                        </span>

                        <div class="text-sm text-gray-600 space-y-1">

                            @forelse($programa->objetivos as $objetivo)

                                <div>

                                    {{ $objetivo->codigo }}
                                    -
                                    {{ $objetivo->nombre }}

                                </div>

                            @empty

                                <span>No registra</span>

                            @endforelse

                        </div>

                    </div>

                    <!-- Registrado por -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Registrado por
                        </span>

                        <span class="text-sm text-gray-600">

                            {{ $programa->usuario->nombres }}
                            {{ $programa->usuario->apellidos }}

                        </span>

                    </div>

                </div>

            </div>

            <!-- Estado -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado del programa
                    </h4>

                </div>

            </div>

            <div class="px-4 py-2">

                <div class="flex items-center mb-4">

                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Estado
                    </span>

                    @if($programa->estado == 'Activo')

                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Activo
                        </span>

                    @else

                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                            Inactivo
                        </span>

                    @endif

                    <a href="{{ route('programas.edit', $programa->id) }}"
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
                            {{ $programa->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Última actualización
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $programa->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-programas-layout>