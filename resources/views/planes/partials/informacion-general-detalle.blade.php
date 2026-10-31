<!-- Información del plan -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between gap-4 px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información del plan
        </h4>

        @if(puedeHacer('planes', 'editar'))

            <a href="{{ route('planes.edit', $plan->id) }}"
               data-editar-plan
               class="text-sm text-blue-600 hover:text-blue-800
                      hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>

<!-- Datos editables del plan -->
<div class="px-4 py-5">

    <dl class="min-w-0 space-y-5">

        <!-- Nombre -->
        <div class="flex min-w-0 flex-col gap-1 sm:flex-row sm:gap-4">

            <dt class="flex-shrink-0 text-sm font-semibold
                       text-gray-700 sm:w-44">

                Nombre del plan

            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm
                       font-medium text-[#0F766E]">

                {{ $plan->nombre ?? 'No registra' }}

            </dd>

        </div>

        <!-- Período -->
        <div class="flex min-w-0 flex-col gap-1 sm:flex-row sm:gap-4">

            <dt class="flex-shrink-0 text-sm font-semibold
                       text-gray-700 sm:w-44">

                Período de vigencia

            </dt>

            <dd class="min-w-0 flex-1 text-sm text-gray-600">

                {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}

            </dd>

        </div>

        <!-- Descripción -->
        <div class="flex min-w-0 flex-col gap-1 sm:flex-row sm:gap-4">

            <dt class="flex-shrink-0 text-sm font-semibold
                       text-gray-700 sm:w-44">

                Descripción

            </dt>

            <dd class="min-w-0 flex-1 whitespace-pre-line break-words text-sm leading-relaxed text-gray-600">{{ $plan->descripcion ?: 'No registra' }}</dd>

        </div>

    </dl>

</div>