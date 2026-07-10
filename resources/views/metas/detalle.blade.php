<x-objetivos-layout title="Detalle de la Meta">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('metas.listar') }}"
            class="py-2 text-sm font-medium text-blue-600 hover:text-green-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

            <a href="{{ route('metas.detalle', $meta->id) }}"
            class="{{ request()->routeIs('metas.detalle')
                        ? 'px-3 py-2 text-sm text-green-700 bg-gray-100 transition'
                        : 'px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition' }}">

                <i class="bi bi-info-circle text-green-600 me-2"></i>

                Información General

            </a>

            <a href="#"
            class="{{ request()->routeIs('metas.indicadores')
                        ? 'px-3 py-2 text-sm text-green-700 bg-gray-100 transition'
                        : 'px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition' }}">

                <i class="bi bi-graph-up text-green-600 me-2"></i>

                Indicadores

            </a>

            <a href="#"
            class="{{ request()->routeIs('metas.seguimiento')
                        ? 'px-3 py-2 text-sm text-green-700 bg-gray-100 transition'
                        : 'px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition' }}">

                <i class="bi bi-clipboard-data text-green-600 me-2"></i>

                Seguimiento

            </a>

            <a href="#"
            class="{{ request()->routeIs('metas.presupuesto')
                        ? 'px-3 py-2 text-sm text-green-700 bg-gray-100 transition'
                        : 'px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition' }}">

                <i class="bi bi-cash-stack text-green-600 me-2"></i>

                Presupuesto

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

                    <i class="bi bi-bullseye"></i>

                </div>

                <div>

                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $meta->nombre }}
                    </h2>

                    <p class="text-gray-500">
                        {{ $meta->codigo }}
                    </p>

                </div>

            </div>

            <!-- Información General -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="flex justify-between items-center px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    <a href="{{ route('metas.edit', $meta->id) }}"
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
                            {{ $meta->codigo }}
                        </span>

                    </div>

                    <!-- Objetivo -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Objetivo Estratégico
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $meta->objetivo->codigo }} - {{ $meta->objetivo->nombre }}
                        </span>

                    </div>

                    <!-- Plan -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Plan
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $meta->objetivo->plan->codigo }} - {{ $meta->objetivo->plan->nombre }}
                        </span>

                    </div>

                    <!-- Nombre -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>

                        <span class="text-sm font-medium text-[#16A34A]">
                            {{ $meta->nombre }}
                        </span>

                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Descripción
                        </span>

                        <span class="text-sm text-gray-600 leading-relaxed">
                            {{ $meta->descripcion ?: 'No registra' }}
                        </span>

                    </div>

                    <!-- Línea base -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Línea base
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ number_format($meta->linea_base, 2) }}
                            {{ $meta->unidad_medida }}
                        </span>

                    </div>

                    <!-- Valor meta -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Valor meta
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ number_format($meta->valor_meta, 2) }}
                            {{ $meta->unidad_medida }}
                        </span>

                    </div>

                    <!-- Unidad -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Unidad de medida
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $meta->unidad_medida }}
                        </span>

                    </div>

                    <!-- Período -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Período
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $meta->periodo_inicio }} - {{ $meta->periodo_fin }}
                        </span>

                    </div>

                    <!-- Responsable -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Responsable
                        </span>

                        <span class="text-sm text-gray-600">

                            {{ $meta->responsable->nombres }}
                            {{ $meta->responsable->apellidos }}

                            @if($meta->responsable->cargo)
                                - {{ $meta->responsable->cargo }}
                            @endif

                        </span>

                    </div>

                    <!-- Registrado por -->
                    <div class="flex">

                        <span class="w-44 text-sm font-semibold text-gray-700">
                            Registrado por
                        </span>

                        <span class="text-sm text-gray-600">

                            {{ $meta->usuario->nombres }}
                            {{ $meta->usuario->apellidos }}

                        </span>

                    </div>

                </div>

            </div>


            <!-- Estado -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado de la meta
                    </h4>

                </div>

            </div>

            <div class="px-4 py-2">

                <div class="flex items-center mb-4">

                    <div class="flex items-center">

                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Estado
                        </span>

                        @if($meta->estado == 'Activo')

                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Habilitada
                            </span>

                        @else

                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                Deshabilitada
                            </span>

                        @endif

                        <a href="#"
                        class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">

                            Editar

                        </a>

                    </div>

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

                    <!-- Fecha de creación -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Fecha de creación
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $meta->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                    <!-- Última actualización -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Última actualización
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $meta->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                </div>

            </div>
        </div>
    </div>

</x-objetivos-layout>