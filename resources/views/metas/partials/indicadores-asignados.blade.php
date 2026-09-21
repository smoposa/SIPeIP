<!-- Indicadores asignados -->
<div id="indicadores-asignados"
     class="mt-4 border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Indicadores asignados
        </h4>

        <span class="rounded-full bg-blue-100 px-2.5 py-0.5
                     text-xs font-semibold text-blue-700">

            {{ $meta->indicadores->count() }}

            {{ $meta->indicadores->count() === 1
                ? 'indicador'
                : 'indicadores' }}

        </span>

    </div>

</div>

<div class="mb-4 px-4 py-3">

    @forelse($meta->indicadores as $indicador)

        <!-- Tarjeta del indicador -->
        <div class="mb-2 rounded-md border border-gray-200 bg-white
                    px-3 py-2.5 shadow-sm last:mb-0">

            <!-- Encabezado -->
            <div class="flex min-w-0 items-start justify-between gap-3">

                <div class="min-w-0 flex-1">

                    <div class="flex flex-wrap items-center gap-2">

                        <!-- Código -->
                        <span class="text-sm font-semibold text-blue-700">
                            {{ $indicador->codigo }}
                        </span>

                        <!-- Estado -->
                        @if($indicador->estado === 'Activo')

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

                        {{ $indicador->nombre }}

                    </p>

                </div>

                <!-- Ver detalle -->
                <a href="{{ route('indicadores.detalle', $indicador->id) }}"
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

                <!-- Tipo -->
                <p>

                    <span class="font-semibold text-gray-700">
                        Tipo:
                    </span>

                    {{ $indicador->tipo ?: 'No registra' }}

                </p>

                <!-- Unidad de medida -->
                <p>

                    <span class="font-semibold text-gray-700">
                        Unidad de medida:
                    </span>

                    {{ $indicador->unidad_medida ?: 'No registra' }}

                </p>

                <!-- Frecuencia -->
                <p>

                    <span class="font-semibold text-gray-700">
                        Frecuencia:
                    </span>

                    {{ $indicador->frecuencia ?: 'No registra' }}

                </p>

                <!-- Fórmula -->
                <p class="break-words">

                    <span class="font-semibold text-gray-700">
                        Fórmula:
                    </span>

                    {{ $indicador->formula ?: 'No registra' }}

                </p>

                <!-- Responsable -->
                <p class="break-words">

                    <span class="font-semibold text-gray-700">
                        Responsable:
                    </span>

                    {{ $indicador->responsable?->name ?? 'No registra' }}

                </p>

            </div>

        </div>

    @empty

        <!-- Estado vacío -->
        <div class="rounded-md border border-dashed border-gray-300
                    bg-gray-50 px-5 py-6 text-center">

            <div class="mx-auto flex h-10 w-10 items-center justify-center
                        rounded-full bg-blue-100 text-lg text-blue-600">

                <i class="bi bi-graph-up-arrow"></i>

            </div>

            <p class="mt-2 text-sm font-semibold text-gray-700">
                No hay indicadores registrados para esta meta.
            </p>

            <p class="mt-1 text-xs text-gray-500">
                Registre el primer indicador para medir el cumplimiento de la meta institucional.
            </p>

            @if(puedeVer('indicadores') && $meta->estado === 'Activo')

                <a href="{{ route('indicadores.create', ['meta_id' => $meta->id]) }}"
                   class="mt-3 inline-flex items-center rounded-md bg-blue-600
                          px-3 py-1.5 text-xs font-medium text-white
                          hover:bg-blue-700">

                    <i class="bi bi-plus-lg me-1.5"></i>
                    Registrar primer indicador

                </a>

            @endif

        </div>

    @endforelse

</div>