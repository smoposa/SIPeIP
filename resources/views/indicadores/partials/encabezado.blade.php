@if(
    $planSeleccionado &&
    $objetivoSeleccionado &&
    $metaSeleccionada
)

    <!-- Contexto completo de planificación -->
    <input type="hidden"
           name="plan_id"
           value="{{ $planSeleccionado->id }}">

    <input type="hidden"
           name="objetivo_id"
           value="{{ $objetivoSeleccionado->id }}">

    <input type="hidden"
           name="meta_id"
           value="{{ $metaSeleccionada->id }}">

    <!-- Meta institucional seleccionada -->
    <div class="mb-8">

        <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

            <h2 class="text-sm font-semibold text-gray-700">
                Meta institucional seleccionada
            </h2>

        </div>

        <div class="min-w-0 pl-8">

            <p class="mb-5 text-xs text-gray-500">
                El indicador quedará asociado automáticamente a esta meta,
                su objetivo estratégico y su plan institucional.
            </p>

            <!-- Código de la meta -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Código de la meta
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                    {{ $metaSeleccionada->codigo }}
                </span>

            </div>

            <!-- Nombre de la meta -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Nombre de la meta
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                    {{ $metaSeleccionada->nombre }}
                </span>

            </div>

            <!-- Objetivo estratégico -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Objetivo estratégico
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">

                    {{ $objetivoSeleccionado->codigo }}
                    -
                    {{ $objetivoSeleccionado->nombre }}

                </span>

            </div>

            <!-- Plan institucional -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Plan institucional
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">

                    {{ $planSeleccionado->codigo }}
                    -
                    {{ $planSeleccionado->nombre }}

                </span>

            </div>

            <!-- Entidad -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Nombre de la entidad
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                    {{ $planSeleccionado->entidad?->nombre ?? 'No registra' }}
                </span>

            </div>

            <!-- Estado de la meta -->
            <div class="flex min-w-0 items-center gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Estado de la meta
                </span>

                @if($metaSeleccionada->estado === 'Activo')

                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1
                                 text-xs font-medium text-green-700">
                        Activa
                    </span>

                @else

                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1
                                 text-xs font-medium text-red-700">
                        Inactiva
                    </span>

                @endif

            </div>

        </div>

    </div>

@endif