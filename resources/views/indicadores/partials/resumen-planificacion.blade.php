<!-- Resumen de planificación -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Resumen de planificación
        </h4>

    </div>

</div>

<div class="px-4 py-5">

    <div class="min-w-0 space-y-4">

        <!-- Plan institucional -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Plan institucional
            </span>

            <div class="min-w-0 flex-1">

                @if($indicador->meta?->objetivo?->plan)

                    <a href="{{ route(
                        'planes.detalle',
                        $indicador->meta->objetivo->plan->id
                    ) }}"
                       class="break-words text-sm font-medium text-blue-600
                              hover:text-blue-800 hover:underline">

                        {{ $indicador->meta->objetivo->plan->codigo }}
                        -
                        {{ $indicador->meta->objetivo->plan->nombre }}

                    </a>

                @else

                    <span class="text-sm text-gray-500">
                        No registra
                    </span>

                @endif

            </div>

        </div>

        <!-- Objetivo estratégico -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Objetivo estratégico
            </span>

            <div class="min-w-0 flex-1">

                @if($indicador->meta?->objetivo)

                    <a href="{{ route(
                        'objetivos.detalle',
                        $indicador->meta->objetivo->id
                    ) }}"
                       class="break-words text-sm font-medium text-blue-600
                              hover:text-blue-800 hover:underline">

                        {{ $indicador->meta->objetivo->codigo }}
                        -
                        {{ $indicador->meta->objetivo->nombre }}

                    </a>

                @else

                    <span class="text-sm text-gray-500">
                        No registra
                    </span>

                @endif

            </div>

        </div>

        <!-- Meta institucional -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Meta institucional
            </span>

            <div class="min-w-0 flex-1">

                @if($indicador->meta)

                    <a href="{{ route(
                        'metas.detalle',
                        $indicador->meta->id
                    ) }}"
                       class="break-words text-sm font-medium text-blue-600
                              hover:text-blue-800 hover:underline">

                        {{ $indicador->meta->codigo }}
                        -
                        {{ $indicador->meta->nombre }}

                    </a>

                @else

                    <span class="text-sm text-gray-500">
                        No registra
                    </span>

                @endif

            </div>

        </div>

        <!-- Indicador actual -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Indicador
            </span>

            <div class="min-w-0 flex-1">

                <div class="flex flex-wrap items-center gap-2">

                    <span class="text-sm font-semibold text-[#0F766E]">
                        {{ $indicador->codigo }}
                        -
                        {{ $indicador->nombre }}
                    </span>

                    @if($indicador->estado === 'Activo')

                        <span class="rounded-full bg-green-100 px-2.5 py-1
                                     text-xs font-medium text-green-700">
                            Activo
                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-2.5 py-1
                                     text-xs font-medium text-red-700">
                            Inactivo
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>