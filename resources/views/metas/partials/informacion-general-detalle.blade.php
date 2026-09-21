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