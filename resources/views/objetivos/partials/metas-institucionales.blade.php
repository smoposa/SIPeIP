<!-- Metas institucionales -->
<div id="metas-institucionales"
     class="mt-4 border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Metas institucionales
        </h4>

        <span class="rounded-full bg-blue-100 px-2.5 py-0.5
                     text-xs font-semibold text-blue-700">

            {{ $objetivo->metas->count() }}

            {{ $objetivo->metas->count() === 1
                ? 'meta'
                : 'metas' }}

        </span>

    </div>

</div>

<div class="mb-4 px-4 py-3">

    @forelse($objetivo->metas as $meta)

        <!-- Tarjeta de la meta -->
        <div class="mb-2 rounded-md border border-gray-200 bg-white
                    px-3 py-2.5 shadow-sm last:mb-0">

            <!-- Cabecera -->
            <div class="flex min-w-0 items-start justify-between gap-3">

                <div class="min-w-0 flex-1">

                    <div class="flex flex-wrap items-center gap-2">

                        <!-- Código -->
                        <span class="text-sm font-semibold text-blue-700">
                            {{ $meta->codigo }}
                        </span>

                        <!-- Estado -->
                        @if($meta->estado === 'Activo')

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

                    <!-- Nombre -->
                    <p class="mt-1 break-words text-sm font-semibold
                              leading-5 text-gray-800">

                        {{ $meta->nombre }}

                    </p>

                </div>

                <!-- Ver detalle -->
                <a href="{{ route('metas.detalle', $meta->id) }}"
                   class="inline-flex flex-shrink-0 items-center rounded-md
                          border border-blue-200 px-2.5 py-1.5 text-xs
                          font-medium text-blue-700 transition
                          hover:bg-blue-50">

                    <i class="bi bi-eye me-1.5"></i>
                    Ver detalle

                </a>

            </div>

            <!-- Información resumida -->
            <div class="mt-2 space-y-1 text-xs leading-5 text-gray-600">

                <!-- Período -->
                <p>

                    <span class="font-semibold text-gray-700">
                        Período:
                    </span>

                    {{ $meta->periodo_inicio ?? 'No registra' }}
                    -
                    {{ $meta->periodo_fin ?? 'No registra' }}

                </p>

                <!-- Línea base -->
                <p>

                    <span class="font-semibold text-gray-700">
                        Línea base:
                    </span>

                    {{ $meta->linea_base ?? 'No registra' }}

                    @if($meta->unidad_medida)
                        {{ $meta->unidad_medida }}
                    @endif

                </p>

                <!-- Valor meta -->
                <p>

                    <span class="font-semibold text-gray-700">
                        Valor meta:
                    </span>

                    {{ $meta->valor_meta ?? 'No registra' }}

                    @if($meta->unidad_medida)
                        {{ $meta->unidad_medida }}
                    @endif

                </p>

                <!-- Responsable -->
                <p class="break-words">

                    <span class="font-semibold text-gray-700">
                        Responsable:
                    </span>

                    {{ $meta->responsable?->name ?? 'No registra' }}

                </p>

                <!-- Indicadores -->
                <p>

                    <span class="font-semibold text-gray-700">
                        Indicadores:
                    </span>

                    {{ $meta->indicadores_count
                        ?? $meta->indicadores->count() }}

                </p>

            </div>

        </div>

    @empty

        <!-- Estado vacío -->
        <div class="rounded-md border border-dashed border-gray-300
                    bg-gray-50 px-5 py-6 text-center">

            <div class="mx-auto flex h-10 w-10 items-center justify-center
                        rounded-full bg-blue-100 text-lg text-blue-600">

                <i class="bi bi-flag"></i>

            </div>

            <p class="mt-2 text-sm font-semibold text-gray-700">
                No hay metas institucionales registradas para este objetivo.
            </p>

            <p class="mt-1 text-xs text-gray-500">
                Registre la primera meta para continuar con la definición de indicadores.
            </p>

            @if(puedeVer('metas') && $objetivo->estado === 'Activo')

                <a href="{{ route('metas.create', ['objetivo_id' => $objetivo->id]) }}"
                   class="mt-3 inline-flex items-center rounded-md bg-blue-600
                          px-3 py-1.5 text-xs font-medium text-white
                          hover:bg-blue-700">

                    <i class="bi bi-plus-lg me-1.5"></i>
                    Registrar primera meta

                </a>

            @endif

        </div>

    @endforelse

</div>