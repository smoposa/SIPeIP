<!-- Consulta del objetivo desde el plan -->
<dialog id="panelObjetivoPlan-{{ $objetivo->id }}"
        data-panel-consulta-objetivo
        aria-labelledby="tituloObjetivoPlan-{{ $objetivo->id }}"
        class="bg-white p-0 shadow-xl"
        style="position: fixed;
               inset: 0 0 0 auto;
               margin: 0 0 0 auto;
               width: min(100%, 600px);
               max-width: 100%;
               height: 100dvh;
               max-height: none;
               border: 0;">

    <div class="flex h-full flex-col">

        <!-- Encabezado -->
        <div class="flex items-start justify-between gap-4
                    border-b border-gray-200 px-6 py-5">

            <div class="min-w-0">

                <h2 id="tituloObjetivoPlan-{{ $objetivo->id }}"
                    class="text-lg font-semibold text-gray-800">

                    Detalle del objetivo

                </h2>

                <p class="mt-1 break-words text-sm font-medium text-blue-700">
                    {{ $objetivo->codigo }}
                </p>

                <p class="mt-1 text-xs text-gray-500">
                    Consulta del objetivo vinculado a este plan.
                </p>

            </div>

            <button type="button"
                    data-cerrar-consulta-objetivo
                    autofocus
                    aria-label="Cerrar detalle del objetivo"
                    class="inline-flex h-9 w-9 flex-shrink-0 items-center
                           justify-center rounded-md text-gray-500
                           hover:bg-gray-100 hover:text-gray-800
                           focus:outline-none focus:ring-2 focus:ring-blue-500">

                <i class="bi bi-x-lg" aria-hidden="true"></i>

            </button>

        </div>

        <!-- Contenido -->
        <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

            <!-- Información del objetivo -->
            <h3 class="border-b border-gray-200 bg-gray-100 px-3 py-2
                       text-sm font-semibold text-gray-800">

                Información del objetivo

            </h3>

            <dl class="space-y-5 py-5 text-sm">

                <div>
                    <dt class="font-semibold text-gray-700">Nombre</dt>

                    <dd class="mt-1 break-words font-medium text-[#0F766E]">
                        {{ $objetivo->nombre }}
                    </dd>
                </div>

                <div>
                    <dt class="font-semibold text-gray-700">Descripción</dt>

                    <dd class="mt-1 whitespace-pre-line break-words leading-relaxed text-gray-600">{{ $objetivo->descripcion ?: 'No registra' }}</dd>
                </div>

                <div>
                    <dt class="font-semibold text-gray-700">Plan institucional</dt>

                    <dd class="mt-1 break-words text-gray-600">
                        {{ $plan->codigo }} · {{ $plan->nombre }}
                    </dd>
                </div>

                <div>
                    <dt class="font-semibold text-gray-700">Estado</dt>

                    <dd class="mt-2">

                        <span class="inline-flex rounded-full px-3 py-1
                                     text-xs font-medium {{
                            $objetivo->estado === 'Activo'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700'
                        }}">
                            {{ $objetivo->estado }}
                        </span>

                    </dd>
                </div>

            </dl>

            <!-- Alineación nacional -->
            <h3 class="border-b border-gray-200 bg-gray-100 px-3 py-2
                       text-sm font-semibold text-gray-800">

                Alineación con el PND

            </h3>

            <dl class="space-y-5 py-5 text-sm">

                <div>
                    <dt class="font-semibold text-gray-700">
                        Objetivo del PND
                    </dt>

                    <dd class="mt-1 break-words text-gray-600">

                        @if($objetivo->pnd)

                            {{ $objetivo->pnd->numero }}
                            -
                            {{ $objetivo->pnd->nombre }}

                        @else

                            No registra

                        @endif

                    </dd>
                </div>

                <div>
                    <dt class="font-semibold text-gray-700">
                        Política del PND
                    </dt>

                    <dd class="mt-1 whitespace-pre-line break-words leading-relaxed text-gray-600">{{ $objetivo->politicaPnd?->nombre ?? $objetivo->politicaPnd?->descripcion ?? 'No registra' }}</dd>
                </div>

            </dl>

            <!-- Alineación internacional -->
            <h3 class="border-b border-gray-200 bg-gray-100 px-3 py-2
                       text-sm font-semibold text-gray-800">

                Alineación con los ODS

            </h3>

            <dl class="space-y-5 py-5 text-sm">

                <div>
                    <dt class="font-semibold text-gray-700">
                        Objetivo de Desarrollo Sostenible
                    </dt>

                    <dd class="mt-1 break-words text-gray-600">

                        @if($objetivo->ods)

                            {{ $objetivo->ods->codigo
                                ?? $objetivo->ods->numero }}

                            -

                            {{ $objetivo->ods->nombre }}

                        @else

                            No registra

                        @endif

                    </dd>
                </div>

                <div>
                    <dt class="font-semibold text-gray-700">
                        Meta ODS
                    </dt>

                    <dd class="mt-1 whitespace-pre-line break-words leading-relaxed text-gray-600">{{ $objetivo->metaOds?->nombre ?? $objetivo->metaOds?->descripcion ?? 'No registra' }}</dd>
                </div>

            </dl>

            <!-- Metas institucionales -->
            <h3 class="border-b border-gray-200 bg-gray-100 px-3 py-2
                       text-sm font-semibold text-gray-800">

                Metas institucionales

            </h3>

            <dl class="py-5 text-sm">

                <div>
                    <dt class="font-semibold text-gray-700">
                        Cantidad de metas vinculadas
                    </dt>

                    <dd class="mt-1 text-gray-600">
                        {{ $objetivo->metas_count ?? 0 }}
                    </dd>
                </div>

            </dl>

            <!-- Auditoría -->
            <h3 class="border-b border-gray-200 bg-gray-100 px-3 py-2
                       text-sm font-semibold text-gray-800">

                Auditoría

            </h3>

            <dl class="space-y-5 py-5 text-sm">

                <div>
                    <dt class="font-semibold text-gray-700">
                        Registrado por
                    </dt>

                    <dd class="mt-1 break-words text-gray-600">

                        {{ trim(
                            ($objetivo->usuario?->nombres ?? '') . ' ' .
                            ($objetivo->usuario?->apellidos ?? '')
                        ) ?: ($objetivo->usuario?->name ?? 'No registra') }}

                    </dd>
                </div>

                <div>
                    <dt class="font-semibold text-gray-700">
                        Fecha de creación
                    </dt>

                    <dd class="mt-1 text-gray-600">
                        {{ $objetivo->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                    </dd>
                </div>

                <div>
                    <dt class="font-semibold text-gray-700">
                        Última actualización
                    </dt>

                    <dd class="mt-1 text-gray-600">
                        {{ $objetivo->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
                    </dd>
                </div>

            </dl>

        </div>

        <!-- Cierre -->
        <div class="flex justify-end border-t border-gray-200 px-6 py-4">

            <button type="button"
                    data-cerrar-consulta-objetivo
                    class="inline-flex h-10 items-center justify-center
                           rounded-md bg-gray-200 px-5 text-sm font-medium
                           text-gray-700 transition hover:bg-gray-300
                           focus:outline-none focus:ring-2 focus:ring-gray-400">

                Cerrar

            </button>

        </div>

    </div>

</dialog>