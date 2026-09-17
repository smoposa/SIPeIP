<x-objetivos-layout title="Detalle del Indicador">

    @if(session('success'))

        <div id="alertSuccess"
             class="fixed right-5 top-5 z-50 rounded-lg
                    bg-green-600 px-6 py-3 text-white shadow-lg">

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
    <div class="border-b border-gray-300 bg-white">

        <div class="flex flex-wrap items-center gap-1">

            <a href="{{ route('indicadores.listar') }}"
               class="mr-6 py-2 text-sm font-medium
                      text-blue-600 hover:text-blue-800">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

            @if(puedeHacer('indicadores', 'editar'))

                <a href="{{ route('indicadores.edit', $indicador->id) }}"
                   class="px-3 py-2 text-sm text-gray-700
                          transition hover:bg-gray-100">

                    <i class="bi bi-pencil mr-2 text-blue-500"></i>
                    Editar información

                </a>

            @endif

            @if(puedeHacer('indicadores', 'estado'))

                <a href="{{ route('indicadores.editarestado', $indicador->id) }}"
                   class="px-3 py-2 text-sm text-gray-700
                          transition hover:bg-gray-100">

                    <i class="bi bi-check2-circle mr-2 text-blue-500"></i>
                    Editar estado

                </a>

            @endif

            <a href="{{ url()->current() }}"
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-arrow-clockwise mr-2 text-blue-500"></i>
                Actualizar

            </a>

        </div>

    </div>

    <!-- Contenido -->
    <div class="min-w-0 w-full overflow-x-hidden overflow-y-auto"
         style="height: calc(100vh - 100px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            <div class="flex min-w-0 items-center gap-4 pb-6">

                <div class="flex h-16 w-16 flex-shrink-0 items-center
                            justify-center rounded-full bg-[#024687]
                            text-3xl text-white">

                    <i class="bi bi-graph-up-arrow"></i>

                </div>

                <div class="min-w-0">

                    <h2 class="break-words text-xl font-semibold text-gray-800">
                        {{ $indicador->nombre }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $indicador->codigo }} · {{ $indicador->tipo }}
                    </p>

                </div>

            </div>

            <!-- Información general -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="flex items-center justify-between px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    @if(puedeHacer('indicadores', 'editar'))

                        <a href="{{ route('indicadores.edit', $indicador->id) }}"
                           class="text-sm text-blue-600 hover:text-blue-800">

                            Editar

                        </a>

                    @endif

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="space-y-4">

                    <!-- Código -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Código
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $indicador->codigo }}
                        </span>

                    </div>

                    <!-- Meta -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Meta institucional
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $indicador->meta?->codigo ?? 'No registra' }}

                            @if($indicador->meta?->nombre)
                                - {{ $indicador->meta->nombre }}
                            @endif
                        </span>

                    </div>

                    <!-- Objetivo -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Objetivo estratégico
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $indicador->meta?->objetivo?->codigo ?? 'No registra' }}

                            @if($indicador->meta?->objetivo?->nombre)
                                - {{ $indicador->meta->objetivo->nombre }}
                            @endif
                        </span>

                    </div>

                    <!-- Plan -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Plan institucional
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $indicador->meta?->objetivo?->plan?->codigo ?? 'No registra' }}

                            @if($indicador->meta?->objetivo?->plan?->nombre)
                                - {{ $indicador->meta->objetivo->plan->nombre }}
                            @endif
                        </span>

                    </div>

                    <!-- Entidad -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Entidad
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $indicador->meta?->objetivo?->plan?->entidad?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Nombre -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>

                        <span class="min-w-0 flex-1 break-words
                                     text-sm font-medium text-[#024687]">
                            {{ $indicador->nombre }}
                        </span>

                    </div>

                </div>

            </div>

            <!-- Medición -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Medición
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="space-y-4">

                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Tipo
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $indicador->tipo }}
                        </span>

                    </div>

                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Fórmula
                        </span>

                        <span class="min-w-0 flex-1 break-words
                                     text-sm leading-relaxed text-gray-600">
                            {{ $indicador->formula }}
                        </span>

                    </div>

                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Unidad de medida
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $indicador->unidad_medida }}
                        </span>

                    </div>

                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Frecuencia
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $indicador->frecuencia }}
                        </span>

                    </div>

                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Responsable
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $indicador->responsable?->nombres ?? 'No registra' }}
                            {{ $indicador->responsable?->apellidos }}

                            @if($indicador->responsable?->cargo)
                                - {{ $indicador->responsable->cargo }}
                            @endif
                        </span>

                    </div>

                </div>

            </div>

            <!-- Estado -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado del indicador
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="flex flex-wrap items-center gap-4">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Estado
                    </span>

                    @if($indicador->estado === 'Activo')

                        <span class="rounded-full bg-green-100 px-3 py-1
                                     text-xs font-medium text-green-700">
                            Activo
                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-3 py-1
                                     text-xs font-medium text-red-700">
                            Inactivo
                        </span>

                    @endif

                    @if(puedeHacer('indicadores', 'estado'))

                        <a href="{{ route('indicadores.editarestado', $indicador->id) }}"
                           class="text-sm text-blue-600
                                  hover:text-blue-800 hover:underline">

                            Editar

                        </a>

                    @endif

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

                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Registrado por
                        </p>

                        <p class="mt-1 break-words text-sm text-gray-600">
                            {{ $indicador->usuario?->nombres
                                ?? $indicador->usuario?->name
                                ?? 'No registra' }}

                            {{ $indicador->usuario?->apellidos }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Fecha de creación
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $indicador->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Última actualización
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $indicador->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-objetivos-layout>