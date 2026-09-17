<x-objetivos-layout title="Detalle de la Meta">

    <!-- Mensaje de éxito -->
    @if(session('success'))

        <div id="alertSuccess"
             class="fixed top-5 right-5 z-50 rounded-lg bg-green-600 px-6 py-3 text-white shadow-lg">

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
    <div class="mb-0 border-b border-gray-300 bg-white">

        <div class="flex flex-wrap items-center">

            <a href="{{ route('metas.listar') }}"
               class="mr-8 py-2 text-sm font-medium text-blue-500 hover:text-blue-800">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

            <a href="{{ route('metas.edit', $meta->id) }}"
               class="px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100">

                <i class="bi bi-pencil text-blue-500 me-2"></i>

                Editar información

            </a>

            <a href="{{ route('metas.editarestado', $meta->id) }}"
               class="px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100">

                <i class="bi bi-check2-circle text-blue-500 me-2"></i>

                Editar estado

            </a>

            <a href="{{ url()->current() }}"
               class="px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100">

                <i class="bi bi-arrow-clockwise text-blue-500 me-2"></i>

                Actualizar

            </a>

        </div>

    </div>

    <!-- Scroll -->
    <div class="min-w-0 w-full max-w-full overflow-y-auto"
         style="
            height: calc(100vh - 180px);
            overflow-x: hidden;
         ">

        <div class="min-w-0 max-w-full bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            <div class="mb-0 flex min-w-0 items-center gap-4 pb-6">

                <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-[#024687] text-3xl text-white">

                    <i class="bi bi-bullseye"></i>

                </div>

                <div class="min-w-0">

                    <h2 class="break-words text-xl font-semibold text-gray-800">
                        {{ $meta->nombre }}
                    </h2>

                    <p class="text-gray-500">
                        {{ $meta->codigo }}
                    </p>

                </div>

            </div>

            <!-- Información general -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="flex items-center justify-between px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    <a href="{{ route('metas.edit', $meta->id) }}"
                       class="text-sm text-blue-600 hover:text-blue-800">

                        Editar

                    </a>

                </div>

            </div>

            <!-- Datos generales -->
            <div class="px-4 py-4">

                <div class="mb-6 space-y-4">

                    <!-- Código -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Código
                        </span>

                        <span class="min-w-0 break-words text-sm text-gray-600">
                            {{ $meta->codigo }}
                        </span>

                    </div>

                    <!-- Objetivo -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Objetivo estratégico
                        </span>

                        <span class="min-w-0 break-words text-sm text-gray-600">

                            {{ $meta->objetivo?->codigo ?? 'No registra' }}

                            @if($meta->objetivo?->nombre)
                                - {{ $meta->objetivo->nombre }}
                            @endif

                        </span>

                    </div>

                    <!-- Plan -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Plan
                        </span>

                        <span class="min-w-0 break-words text-sm text-gray-600">

                            {{ $meta->objetivo?->plan?->codigo ?? 'No registra' }}

                            @if($meta->objetivo?->plan?->nombre)
                                - {{ $meta->objetivo->plan->nombre }}
                            @endif

                        </span>

                    </div>

                    <!-- Entidad -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Entidad
                        </span>

                        <span class="min-w-0 break-words text-sm text-gray-600">
                            {{ $meta->objetivo?->plan?->entidad?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Nombre -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>

                        <span class="min-w-0 break-words text-sm font-medium text-[#024687]">
                            {{ $meta->nombre }}
                        </span>

                    </div>

                    <!-- Descripción -->
                    <div class="flex min-w-0 items-start">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Descripción
                        </span>

                        <span class="min-w-0 break-words text-sm leading-relaxed text-gray-600">
                            {{ $meta->descripcion ?: 'No registra' }}
                        </span>

                    </div>

                </div>

            </div>

            <!-- Valores y período -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Valores y período
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="space-y-4">

                    <!-- Línea base -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Línea base
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ number_format((float) $meta->linea_base, 2) }}
                        </span>

                    </div>

                    <!-- Valor meta -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Valor meta
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ number_format((float) $meta->valor_meta, 2) }}
                        </span>

                    </div>

                    <!-- Unidad -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Unidad de medida
                        </span>

                        <span class="min-w-0 break-words text-sm text-gray-600">
                            {{ $meta->unidad_medida }}
                        </span>

                    </div>

                    <!-- Período -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Período
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $meta->periodo_inicio }} - {{ $meta->periodo_fin }}
                        </span>

                    </div>

                    <!-- Responsable -->
                    <div class="flex min-w-0">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Responsable
                        </span>

                        <span class="min-w-0 break-words text-sm text-gray-600">

                            {{ $meta->responsable?->nombres ?? 'No registra' }}
                            {{ $meta->responsable?->apellidos }}

                            @if($meta->responsable?->cargo)
                                - {{ $meta->responsable->cargo }}
                            @endif

                        </span>

                    </div>

                </div>

            </div>

            <!-- Estado -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado de la meta
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="flex items-center">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Estado
                    </span>

                    @if($meta->estado === 'Activo')

                        <span class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-700">
                            Habilitada
                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-2 py-1 text-xs text-red-700">
                            Deshabilitada
                        </span>

                    @endif

                    <a href="{{ route('metas.editarestado', $meta->id) }}"
                       class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">

                        Editar

                    </a>

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

            <div class="px-4 py-4">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                    <!-- Usuario creador -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Registrado por
                        </p>

                        <p class="mt-1 text-sm text-gray-600">

                            {{ $meta->usuario?->nombres
                                ?? $meta->usuario?->name
                                ?? 'No registra' }}

                            {{ $meta->usuario?->apellidos }}

                        </p>

                    </div>

                    <!-- Creación -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Fecha de creación
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $meta->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                    <!-- Actualización -->
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