<x-planes-layout title="Detalle del Plan Institucional">

    @if(session('success'))
        <div id="alertSuccess"
             class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">

            {{ session('success') }}

        </div>

        <script>
            setTimeout(() => {
                const alerta = document.getElementById('alertSuccess');

                if (alerta) {
                    alerta.remove();
                }
            }, 3000);
        </script>
    @endif

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('planes.listar') }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

            <a href="{{ route('planes.edit', $plan->id) }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-pencil text-blue-500 me-2"></i>
                Editar información

            </a>

            <a href="{{ route('planes.editarestado', $plan->id) }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-check2-circle text-blue-500 me-2"></i>
                Editar estado

            </a>

            <a href="{{ url()->current() }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-arrow-clockwise text-blue-500 me-2"></i>
                Actualizar

            </a>

        </div>

    </div>

    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <div class="bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            <div class="flex items-center justify-between gap-4 pb-6">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 rounded-full bg-[#0F766E]
                                flex items-center justify-center
                                text-white text-3xl">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ $plan->nombre }}
                        </h2>

                        <p class="text-gray-500">
                            {{ $plan->codigo }}
                            ·
                            Período {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
                        </p>

                    </div>

                </div>

                <!-- Versión -->
                <div class="text-right">

                    <p class="text-xs text-gray-500">
                        Versión
                    </p>

                    <span class="inline-flex mt-1 px-3 py-1
                                 text-sm font-semibold
                                 rounded-md bg-gray-100 text-gray-700">

                        v{{ $plan->version }}

                    </span>

                </div>

            </div>

            <!-- Información General -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="flex justify-between items-center px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    <a href="{{ route('planes.edit', $plan->id) }}"
                       class="text-sm text-blue-600 hover:text-blue-800">

                        Editar

                    </a>

                </div>

            </div>

            <!-- Datos -->
            <div class="px-4 py-4">

                <div class="space-y-4 mb-6">

                    <!-- Código -->
                    <div class="flex">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Código del plan
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $plan->codigo }}
                        </span>

                    </div>

                    <!-- Nombre -->
                    <div class="flex">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>

                        <span class="text-sm font-medium text-[#0F766E]">
                            {{ $plan->nombre }}
                        </span>

                    </div>

                    <!-- Entidad -->
                    <div class="flex">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Entidad
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $plan->entidad->nombre }}
                        </span>

                    </div>

                    <!-- Tipo -->
                    <div class="flex">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Tipo
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $plan->tipo }}
                        </span>

                    </div>

                    <!-- Período -->
                    <div class="flex">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Período de vigencia
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
                        </span>

                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Descripción
                        </span>

                        <span class="text-sm text-gray-600 leading-relaxed">
                            {{ $plan->descripcion ?: 'No registra' }}
                        </span>

                    </div>

                </div>

            </div>

            <!-- Estado del proceso -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado de planificación
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="flex items-center">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Estado del proceso
                    </span>

                    @switch($plan->estado_proceso)

                        @case('Borrador')

                            <span class="inline-flex px-3 py-1 text-xs rounded-full
                                         bg-gray-100 text-gray-700">

                                Borrador

                            </span>

                            @break

                        @case('En revisión')

                            <span class="inline-flex px-3 py-1 text-xs rounded-full
                                         bg-yellow-100 text-yellow-700">

                                En revisión

                            </span>

                            @break

                        @case('Observado')

                            <span class="inline-flex px-3 py-1 text-xs rounded-full
                                         bg-orange-100 text-orange-700">

                                Observado

                            </span>

                            @break

                        @case('Aprobado')

                            <span class="inline-flex px-3 py-1 text-xs rounded-full
                                         bg-blue-100 text-blue-700">

                                Aprobado

                            </span>

                            @break

                        @default

                            <span class="inline-flex px-3 py-1 text-xs rounded-full
                                         bg-gray-100 text-gray-600">

                                Sin estado

                            </span>

                    @endswitch

                </div>

                <div class="flex items-center mt-4">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Versión
                    </span>

                    <span class="text-sm text-gray-600">
                        v{{ $plan->version }}
                    </span>

                </div>

            </div>

            <!-- Estado administrativo -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado administrativo
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4 mb-4">

                <div class="flex items-center">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Estado
                    </span>

                    @if($plan->estado === 'Activo')

                        <span class="px-3 py-1 text-xs rounded-full
                                     bg-green-100 text-green-700">

                            Activo

                        </span>

                    @else

                        <span class="px-3 py-1 text-xs rounded-full
                                     bg-red-100 text-red-700">

                            Inactivo

                        </span>

                    @endif

                    <a href="{{ route('planes.editarestado', $plan->id) }}"
                       class="ml-10 text-sm text-blue-600
                              hover:text-blue-800 hover:underline">

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

            <div class="px-4 py-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Usuario creador -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Registrado por
                        </p>

                        <p class="mt-1 text-sm text-gray-600">

                            @if($plan->usuario)
                                {{ $plan->usuario->name }}
                            @else
                                No registra
                            @endif

                        </p>

                    </div>

                    <!-- Creación -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Fecha de creación
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $plan->created_at->format('d/m/Y H:i') }}
                        </p>

                    </div>

                    <!-- Actualización -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Última actualización
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $plan->updated_at->format('d/m/Y H:i') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-planes-layout>