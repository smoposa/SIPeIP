@if($planSeleccionado)

    <input type="hidden"
           name="plan_id"
           value="{{ $planSeleccionado->id }}">

    <!-- Plan institucional seleccionado -->
    <div class="mb-8">

        <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

            <h2 class="text-sm font-semibold text-gray-700">
                Plan institucional seleccionado
            </h2>

        </div>

        <div class="min-w-0 pl-8">

            <!-- Código -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Código
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                    {{ $planSeleccionado->codigo }}
                </span>

            </div>

            <!-- Nombre -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Nombre
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                    {{ $planSeleccionado->nombre }}
                </span>

            </div>

            <!-- Entidad -->
            <div class="mb-4 flex min-w-0 items-start gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Entidad
                </span>

                <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                    {{ $planSeleccionado->entidad?->nombre ?? 'No registra' }}
                </span>

            </div>

            <!-- Estado -->
            <div class="flex min-w-0 items-center gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Estado
                </span>

                @if($planSeleccionado->estado === 'Activo')

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