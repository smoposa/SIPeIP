<!-- Objetivos estratégicos institucionales -->
<div id="objetivos-estrategicos"
     class="mt-4 border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Objetivos estratégicos institucionales
        </h4>

        <span class="rounded-full bg-blue-100 px-2.5 py-0.5
                     text-xs font-semibold text-blue-700">

            {{ $plan->objetivos->count() }} OEI

        </span>

    </div>

</div>

<div class="mb-4 px-4 py-3">

    @forelse($plan->objetivos as $objetivo)

        <div class="mb-2 rounded-md border border-gray-200 bg-white
                    px-3 py-2.5 shadow-sm last:mb-0">

            <!-- Encabezado de la tarjeta -->
            <div class="flex min-w-0 items-start justify-between gap-3">

                <div class="min-w-0 flex-1">

                    <div class="flex flex-wrap items-center gap-2">

                        <span class="text-sm font-semibold text-blue-700">
                            {{ $objetivo->codigo }}
                        </span>

                        @if($objetivo->estado === 'Activo')

                            <span class="rounded-full bg-green-100 px-2 py-0.5
                                         text-xs font-medium text-green-700">
                                Activo
                            </span>

                        @else

                            <span class="rounded-full bg-red-100 px-2 py-0.5
                                         text-xs font-medium text-red-700">
                                Inactivo
                            </span>

                        @endif

                    </div>

                    <!-- Nombre del objetivo -->
                    <p class="mt-1 break-words text-sm font-semibold
                              leading-5 text-gray-800">

                        {{ $objetivo->nombre }}

                    </p>

                </div>

                <!-- Acción -->
                <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                   class="inline-flex flex-shrink-0 items-center rounded-md
                          border border-blue-200 px-2.5 py-1.5 text-xs
                          font-medium text-blue-700 transition
                          hover:bg-blue-50">

                    <i class="bi bi-eye me-1.5"></i>
                    Ver detalle

                </a>

            </div>

            <!-- Alineaciones y metas -->
            <div class="mt-2 space-y-1 text-xs leading-5 text-gray-600">

                <!-- PND -->
                <p class="break-words">

                    <span class="font-semibold text-gray-700">
                        PND:
                    </span>

                    Objetivo {{ $objetivo->pnd?->numero ?? 'No registra' }}
                    -
                    {{ $objetivo->pnd?->nombre ?? 'No registra' }}

                </p>

                <!-- ODS -->
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

                <!-- Metas institucionales -->
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

                <i class="bi bi-bullseye"></i>

            </div>

            <p class="mt-2 text-sm font-semibold text-gray-700">
                No hay objetivos estratégicos institucionales registrados.
            </p>

            <p class="mt-1 text-xs text-gray-500">
                Registre el primer OEI para continuar con la planificación institucional.
            </p>

            @if(puedeVer('objetivos') && $plan->estado === 'Activo')

                <a href="{{ route('objetivos.create', ['plan_id' => $plan->id]) }}"
                   class="mt-3 inline-flex items-center rounded-md bg-blue-600
                          px-3 py-1.5 text-xs font-medium text-white
                          hover:bg-blue-700">

                    <i class="bi bi-plus-lg me-1.5"></i>
                    Registrar primer OEI

                </a>

            @endif

        </div>

    @endforelse

</div>