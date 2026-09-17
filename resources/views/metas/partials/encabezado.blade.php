@if($planSeleccionado && $objetivoSeleccionado)

    <!-- Contexto seleccionado -->
    <input type="hidden"
           name="plan_id"
           value="{{ $planSeleccionado->id }}">

    <input type="hidden"
           name="objetivo_id"
           value="{{ $objetivoSeleccionado->id }}">

    <!-- Objetivo estratégico seleccionado -->
    <div class="mb-8">

        <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

            <h2 class="text-sm font-semibold text-gray-700">
                Objetivo estratégico seleccionado
            </h2>

        </div>

        <div class="min-w-0 pl-8">

            <p class="mb-5 text-xs text-gray-500">
                La meta quedará asociada automáticamente a este objetivo y a su plan institucional.
            </p>

            <!-- Código del objetivo -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Código del objetivo
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                    {{ $objetivoSeleccionado->codigo }}
                </span>

            </div>

            <!-- Nombre del objetivo -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Nombre del objetivo
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
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

            <!-- Estado administrativo -->
            <div class="flex min-w-0 items-center gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Estado del objetivo
                </span>

                @if($objetivoSeleccionado->estado === 'Activo')

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

            </div>

        </div>

    </div>

@endif