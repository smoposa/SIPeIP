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