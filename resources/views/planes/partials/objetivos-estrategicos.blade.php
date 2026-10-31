<!-- Objetivos estratégicos institucionales -->
<div id="objetivos-estrategicos"
     class="mt-4 border-b border-gray-200 bg-gray-100">

    <div class="flex flex-wrap items-center justify-between gap-4 px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Objetivos estratégicos institucionales
        </h4>

        @if(
            puedeVer('objetivos')
            && puedeHacer('objetivos', 'crear')
            && $plan->estado === 'Activo'
        )

            <a href="{{ route('objetivos.create', ['plan_id' => $plan->id]) }}"
               class="inline-flex items-center gap-2 text-sm
                      font-medium text-blue-600
                      hover:text-blue-800 hover:underline">

                <i class="bi bi-plus-circle" aria-hidden="true"></i>
                Registrar objetivo

            </a>

        @endif

    </div>

</div>

<div class="mb-4 px-4 py-3">

    @forelse($plan->objetivos as $objetivo)

        <div class="mb-2 rounded-md border border-gray-200 bg-white
                    px-3 py-2.5 shadow-sm last:mb-0">

            <!-- Encabezado -->
            <div class="flex min-w-0 flex-wrap items-start justify-between gap-3">

                <div class="min-w-0 flex-1">

                    <div class="flex flex-wrap items-center gap-2">

                        <span class="text-sm font-semibold text-blue-700">
                            {{ $objetivo->codigo }}
                        </span>

                        <span class="rounded-full px-2 py-0.5 text-xs font-medium {{
                            $objetivo->estado === 'Activo'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700'
                        }}">
                            {{ $objetivo->estado }}
                        </span>

                    </div>

                    <p class="mt-1 break-words text-sm font-semibold
                              leading-5 text-gray-800">

                        {{ $objetivo->nombre }}

                    </p>

                </div>

                <!-- Consultar sin salir del plan -->
                @if(puedeVer('objetivos'))

                    <button type="button"
                            data-consultar-objetivo
                            data-panel-objetivo="panelObjetivoPlan-{{ $objetivo->id }}"
                            aria-haspopup="dialog"
                            aria-controls="panelObjetivoPlan-{{ $objetivo->id }}"
                            class="inline-flex flex-shrink-0 items-center rounded-md
                                   border border-blue-200 px-2.5 py-1.5 text-xs
                                   font-medium text-blue-700 transition
                                   hover:bg-blue-50 focus:outline-none
                                   focus:ring-2 focus:ring-blue-500">

                        
                        Detalle

                    </button>

                @endif

            </div>

            <!-- Alineaciones y metas -->
            <div class="mt-2 space-y-1 text-xs leading-5 text-gray-600">

                <p class="break-words">

                    <span class="font-semibold text-gray-700">
                        PND:
                    </span>

                    Objetivo {{ $objetivo->pnd?->numero ?? 'No registra' }}
                    -
                    {{ $objetivo->pnd?->nombre ?? 'No registra' }}

                </p>

                <p class="break-words">

                    <span class="font-semibold text-gray-700">
                        ODS:
                    </span>

                    {{ $objetivo->ods?->codigo
                        ?? $objetivo->ods?->numero
                        ?? 'No registra' }}

                    -

                    {{ $objetivo->ods?->nombre ?? 'No registra' }}

                </p>

                <p>

                    <span class="font-semibold text-gray-700">
                        Metas institucionales:
                    </span>

                    {{ $objetivo->metas_count ?? 0 }}

                </p>

            </div>

        </div>

    @empty

        <div class="rounded-md border border-dashed border-gray-300
                    bg-gray-50 px-5 py-6 text-center">

            <div class="mx-auto flex h-10 w-10 items-center justify-center
                        rounded-full bg-blue-100 text-lg text-blue-600">

                <i class="bi bi-bullseye" aria-hidden="true"></i>

            </div>

            <p class="mt-2 text-sm font-semibold text-gray-700">
                No hay objetivos estratégicos institucionales registrados.
            </p>

            @if(
                puedeVer('objetivos')
                && puedeHacer('objetivos', 'crear')
                && $plan->estado === 'Activo'
            )

                <p class="mt-1 text-xs text-gray-500">
                    Registre el primer OEI para continuar con la planificación institucional.
                </p>

                <a href="{{ route('objetivos.create', ['plan_id' => $plan->id]) }}"
                class="mt-3 inline-flex items-center rounded-md bg-[#024687]
                        px-3 py-1.5 text-xs font-medium text-white
                        hover:bg-[#01325f]">

                    <i class="bi bi-plus-lg me-1.5" aria-hidden="true"></i>
                    Registrar primer OEI

                </a>

            @endif

        </div>

    @endforelse

</div>

<!-- Paneles de consulta de los objetivos del plan -->
@if(puedeVer('objetivos'))

    @foreach($plan->objetivos as $objetivo)

        @include('planes.partials.panel-objetivo', [
            'objetivo' => $objetivo,
        ])

    @endforeach

@endif