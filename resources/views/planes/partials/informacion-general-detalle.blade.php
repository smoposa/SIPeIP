<!-- Información general -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información general
        </h4>

        @if(puedeHacer('planes', 'editar'))

            <a href="{{ route('planes.edit', $plan->id) }}"
               class="text-sm text-blue-600 hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>

<!-- Datos del plan -->
<div class="px-4 py-5">

    <div class="min-w-0 space-y-5">

        <!-- Entidad -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre de la entidad
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $plan->entidad?->nombre ?? 'No registra' }}
            </span>

        </div>

        <!-- Código -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Código del plan
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $plan->codigo ?? 'No registra' }}
            </span>

        </div>

        <!-- Tipo -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Tipo de plan
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $plan->tipo ?: 'No registra' }}
            </span>

        </div>

        <!-- Período -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Período de vigencia
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
            </span>

        </div>

        <!-- Nombre -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre del plan
            </span>

            <span class="min-w-0 flex-1 break-words text-sm font-medium text-[#0F766E]">
                {{ $plan->nombre ?? 'No registra' }}
            </span>

        </div>

        <!-- Descripción -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Descripción
            </span>

            <span class="min-w-0 flex-1 whitespace-pre-line break-words
                         text-sm leading-relaxed text-gray-600">
                {{ $plan->descripcion ?: 'No registra' }}
            </span>

        </div>

    </div>

</div>