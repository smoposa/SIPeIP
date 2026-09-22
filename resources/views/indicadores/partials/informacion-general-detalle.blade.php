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