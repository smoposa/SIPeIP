            <div class="border-b border-gray-200 bg-gray-100">

                <div class="flex items-center justify-between px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    <a href="{{ route('objetivos.edit', $objetivo->id) }}"
                       class="text-sm text-blue-600 hover:text-blue-800">

                        Editar

                    </a>

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
                            {{ $objetivo->codigo }}
                        </span>

                    </div>

                    <!-- Plan -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Plan
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->plan?->codigo ?? 'No registra' }}
                            -
                            {{ $objetivo->plan?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Objetivo PND -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Objetivo PND
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            Objetivo {{ $objetivo->pnd?->numero ?? 'No registra' }}
                            -
                            {{ $objetivo->pnd?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Política PND -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Política PND
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->politicaPnd?->codigo ?? 'No registra' }}
                            -
                            {{ $objetivo->politicaPnd?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- ODS -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            ODS
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->ods?->codigo ?? 'No registra' }}
                            -
                            {{ $objetivo->ods?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Meta ODS -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Meta ODS
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->metaOds?->codigo ?? 'No registra' }}
                            -
                            {{ $objetivo->metaOds?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Nombre -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm font-medium text-[#024687]">
                            {{ $objetivo->nombre }}
                        </span>

                    </div>

                    <!-- Descripción -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Descripción
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm leading-relaxed text-gray-600">
                            {{ $objetivo->descripcion ?: 'No registra' }}
                        </span>

                    </div>

                </div>

            </div>