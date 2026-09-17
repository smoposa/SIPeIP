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

            @if(puedeHacer('planes', 'editar'))

                <a href="{{ route('planes.edit', $plan->id) }}"
                   class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                    <i class="bi bi-pencil text-blue-500 me-2"></i>
                    Editar información

                </a>

            @endif

            @if(puedeHacer('planes', 'estado'))

                <a href="{{ route('planes.editarestado', $plan->id) }}"
                   class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                    <i class="bi bi-check2-circle text-blue-500 me-2"></i>
                    Editar estado

                </a>

            @endif

            <a href="{{ url()->current() }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-arrow-clockwise text-blue-500 me-2"></i>
                Actualizar

            </a>

        </div>

    </div>

    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 100px);">

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

                    @if(puedeHacer('planes', 'editar'))

                        <a href="{{ route('planes.edit', $plan->id) }}"
                           class="text-sm text-blue-600 hover:text-blue-800">

                            Editar

                        </a>

                    @endif

                </div>

            </div>

            <!-- Datos -->
<div class="px-4 py-5">

    <div class="grid min-w-0 grid-cols-1 gap-x-12 gap-y-6 lg:grid-cols-2">

        <!-- Columna izquierda -->
        <div class="min-w-0 space-y-4">

            <!-- Entidad -->
            <div class="flex min-w-0 items-start gap-4">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Nombre de la entidad
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                    {{ $plan->entidad?->nombre ?? 'No registra' }}
                </span>

            </div>

            <!-- Código -->
            <div class="flex min-w-0 items-start gap-4">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Código del plan
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                    {{ $plan->codigo }}
                </span>

            </div>

            <!-- Nombre -->
            <div class="flex min-w-0 items-start gap-4">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Nombre del plan
                </span>

                <span class="min-w-0 flex-1 break-words text-sm font-medium text-[#0F766E]">
                    {{ $plan->nombre }}
                </span>

            </div>

            <!-- Descripción -->
            <div class="flex min-w-0 items-start gap-4">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Descripción
                </span>

                <span class="min-w-0 flex-1 break-words text-sm leading-relaxed text-gray-600">
                    {{ $plan->descripcion ?: 'No registra' }}
                </span>

            </div>

        </div>

        <!-- Columna derecha -->
        <div class="min-w-0 space-y-4">

            <!-- Tipo -->
            <div class="flex min-w-0 items-start gap-4">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Tipo de plan
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                    {{ $plan->tipo ?: 'No registra' }}
                </span>

            </div>

            <!-- Período -->
            <div class="flex min-w-0 items-start gap-4">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Período de vigencia
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                    {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
                </span>

            </div>

        </div>

    </div>

</div>

<!-- Estado y versión del plan -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado y versión del plan
        </h4>

    </div>

</div>

<div class="mb-4 px-4 py-5">

    <div class="space-y-4">

        <!-- Estado administrativo -->
        <div class="flex min-w-0 items-center gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado administrativo
            </span>

            <div class="flex min-w-0 flex-1 flex-wrap items-center gap-4">

                @if($plan->estado === 'Activo')

                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1
                                 text-xs font-medium text-green-700">
                        Activo
                    </span>

                @else

                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1
                                 text-xs font-medium text-red-700">
                        Inactivo
                    </span>

                @endif

                @if(puedeHacer('planes', 'estado'))

                    <a href="{{ route('planes.editarestado', $plan->id) }}"
                       class="text-sm font-medium text-blue-600
                              hover:text-blue-800 hover:underline">

                        Editar

                    </a>

                @endif

            </div>

        </div>

        <!-- Estado del proceso -->
        <div class="flex min-w-0 items-center gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado del proceso
            </span>

            <div class="min-w-0 flex-1">

                @switch($plan->estado_proceso)

                    @case('Borrador')

                        <span class="inline-flex rounded-full bg-gray-100 px-3 py-1
                                     text-xs font-medium text-gray-700">
                            Borrador
                        </span>

                        @break

                    @case('En revisión')

                        <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1
                                     text-xs font-medium text-yellow-700">
                            En revisión
                        </span>

                        @break

                    @case('Observado')

                        <span class="inline-flex rounded-full bg-orange-100 px-3 py-1
                                     text-xs font-medium text-orange-700">
                            Observado
                        </span>

                        @break

                    @case('Aprobado')

                        <span class="inline-flex rounded-full bg-blue-100 px-3 py-1
                                     text-xs font-medium text-blue-700">
                            Aprobado
                        </span>

                        @break

                    @default

                        <span class="inline-flex rounded-full bg-gray-100 px-3 py-1
                                     text-xs font-medium text-gray-600">
                            Sin estado
                        </span>

                @endswitch

            </div>

        </div>

        <!-- Versión -->
        <div class="flex min-w-0 items-center gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Versión
            </span>

            <div class="min-w-0 flex-1">

                <span class="inline-flex rounded-md bg-gray-100 px-3 py-1
                             text-sm font-medium text-gray-700">

                    v{{ $plan->version }}

                </span>

            </div>

        </div>

    </div>

</div>

<!-- Auditoría -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Auditoría
        </h4>

    </div>

</div>

<div class="px-4 py-5">

    <div class="space-y-4">

        <!-- Usuario creador -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Registrado por
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $plan->usuario?->name ?? 'No registra' }}
            </span>

        </div>

        <!-- Fecha de creación -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Fecha de creación
            </span>

            <span class="min-w-0 flex-1 text-sm text-gray-600">

                {{ $plan->created_at
                    ? $plan->created_at->format('d/m/Y H:i')
                    : 'No registra' }}

            </span>

        </div>

        <!-- Última actualización -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Última actualización
            </span>

            <span class="min-w-0 flex-1 text-sm text-gray-600">

                {{ $plan->updated_at
                    ? $plan->updated_at->format('d/m/Y H:i')
                    : 'No registra' }}

            </span>

        </div>

    </div>

</div>

        </div>

    </div>

</x-planes-layout>