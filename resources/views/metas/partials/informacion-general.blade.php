@php
    $metaActual = $meta ?? null;

    $esContextoAsistente =
        !$metaActual &&
        !empty($planSeleccionado) &&
        !empty($objetivoSeleccionado);

    $planInicial = old(
        'plan_id',
        $metaActual?->objetivo?->plan_id ?? ''
    );

    $objetivoInicial = old(
        'objetivo_id',
        $metaActual?->objetivo_id ?? ''
    );

    $datosObjetivos = $objetivos
        ->map(
            fn ($objetivo) => [
                'id' => $objetivo->id,
                'plan_id' => $objetivo->plan_id,
                'codigo' => $objetivo->codigo,
                'nombre' => $objetivo->nombre,
            ]
        )
        ->values();

    $unidadesMedida = [
        'Porcentaje' => 'Porcentaje (%)',
        'Número' => 'Número',
        'Personas' => 'Personas',
        'Beneficiarios' => 'Beneficiarios',
        'Centros de Salud' => 'Centros de salud',
        'Hospitales' => 'Hospitales',
        'Establecimientos' => 'Establecimientos',
        'Kilómetros' => 'Kilómetros',
        'Metros cuadrados' => 'Metros cuadrados',
        'Documentos' => 'Documentos',
        'Procesos' => 'Procesos',
        'Capacitaciones' => 'Capacitaciones',
        'Minutos' => 'Minutos',
        'Horas' => 'Horas',
        'Días' => 'Días',
        'Meses' => 'Meses',
        'Años' => 'Años',
        'Unidades' => 'Unidades',
        'Otro' => 'Otro',
    ];
@endphp

<!-- Información general -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información general
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        <!--
            Desde el menú y durante la edición se muestran
            los selectores dependientes Plan → Objetivo.
        -->
        @if(!$esContextoAsistente)

            <!-- Plan institucional -->
            <div class="mb-5 flex min-w-0 items-start gap-4">

                <label for="plan_id"
                       class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                    Plan institucional
                    <span class="text-red-500">*</span>

                </label>

                <div class="min-w-0 flex-1">

                    <select id="plan_id"
                            name="plan_id"
                            required
                            {{ $planes->isEmpty() ? 'disabled' : '' }}
                            class="h-10 w-full min-w-0 rounded-md border-gray-300
                                   px-3 text-sm disabled:cursor-not-allowed
                                   disabled:bg-gray-100">

                        @if($planes->isEmpty())

                            <option value="">
                                No existen planes activos disponibles
                            </option>

                        @else

                            <option value="">
                                Seleccione un plan
                            </option>

                            @foreach($planes as $plan)

                                <option value="{{ $plan->id }}"
                                    {{ (string) $planInicial === (string) $plan->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $plan->codigo }} - {{ $plan->nombre }}

                                </option>

                            @endforeach

                        @endif

                    </select>

                    <p class="mt-1 text-xs text-gray-500">
                        Seleccione el plan al que pertenecerá la meta.
                    </p>

                </div>

            </div>

            <!-- Objetivo estratégico -->
            <div class="mb-5 flex min-w-0 items-start gap-4">

                <label for="objetivo_id"
                       class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                    Objetivo estratégico
                    <span class="text-red-500">*</span>

                </label>

                <div class="min-w-0 flex-1">

                    <select id="objetivo_id"
                            name="objetivo_id"
                            required
                            disabled
                            class="h-10 w-full min-w-0 rounded-md border-gray-300
                                   px-3 text-sm disabled:cursor-not-allowed
                                   disabled:bg-gray-100">

                        <option value="">
                            Seleccione un plan primero
                        </option>

                    </select>

                    <p class="mt-1 text-xs text-gray-500">
                        Solo se mostrarán los objetivos activos del plan seleccionado.
                    </p>

                </div>

            </div>

        @endif

        <!-- Código -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="codigo"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Código de la meta

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="codigo"
                       value="{{ $metaActual?->codigo ?? $codigo ?? '' }}"
                       readonly
                       class="h-10 w-full min-w-0 cursor-not-allowed rounded-md
                              border-gray-300 bg-gray-100 px-3 text-sm text-gray-600">

            </div>

        </div>

        <!-- Nombre -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="nombre"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Nombre de la meta
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="nombre"
                       name="nombre"
                       maxlength="255"
                       value="{{ old('nombre', $metaActual?->nombre ?? '') }}"
                       required
                       placeholder="Ingrese el nombre de la meta"
                       class="h-10 w-full min-w-0 rounded-md border-gray-300
                              px-3 text-sm focus:border-blue-500
                              focus:ring-blue-500">

            </div>

        </div>

        <!-- Descripción -->
        <div class="mb-5 flex min-w-0 items-start gap-4">

            <label for="descripcion"
                   class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                Descripción

            </label>

            <div class="min-w-0 flex-1">

                <textarea id="descripcion"
                          name="descripcion"
                          rows="4"
                          maxlength="1000"
                          placeholder="Ingrese una descripción de la meta"
                          class="w-full min-w-0 rounded-md border-gray-300
                                 px-3 py-2 text-sm focus:border-blue-500
                                 focus:ring-blue-500">{{ old('descripcion', $metaActual?->descripcion ?? '') }}</textarea>

            </div>

        </div>

        <!-- Línea base -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="linea_base"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Línea base
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <input type="number"
                       id="linea_base"
                       name="linea_base"
                       step="0.01"
                       min="0"
                       value="{{ old('linea_base', $metaActual?->linea_base ?? '') }}"
                       required
                       class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

            </div>

        </div>

        <!-- Valor meta -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="valor_meta"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Valor meta
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <input type="number"
                       id="valor_meta"
                       name="valor_meta"
                       step="0.01"
                       min="0"
                       value="{{ old('valor_meta', $metaActual?->valor_meta ?? '') }}"
                       required
                       class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

            </div>

        </div>

        <!-- Unidad de medida -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="unidad_medida"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Unidad de medida
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="unidad_medida"
                        name="unidad_medida"
                        required
                        class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                    <option value="">
                        Seleccione una unidad
                    </option>

                    @foreach($unidadesMedida as $valor => $etiqueta)

                        <option value="{{ $valor }}"
                            {{ old(
                                'unidad_medida',
                                $metaActual?->unidad_medida ?? ''
                            ) === $valor ? 'selected' : '' }}>

                            {{ $etiqueta }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <!-- Período de vigencia -->
        <div class="mb-5 flex min-w-0 items-start gap-4">

            <span class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                Período de vigencia
                <span class="text-red-500">*</span>

            </span>

            <div class="grid min-w-0 flex-1 grid-cols-1 gap-3 sm:grid-cols-2">

                <!-- Año de inicio -->
                <div>

                    <label for="periodo_inicio"
                           class="mb-1 block text-xs font-medium text-gray-500">
                        Año de inicio
                    </label>

                    <input type="number"
                           id="periodo_inicio"
                           name="periodo_inicio"
                           min="2000"
                           max="2100"
                           value="{{ old(
                                'periodo_inicio',
                                $metaActual?->periodo_inicio ?? ''
                           ) }}"
                           required
                           class="h-10 w-full min-w-0 rounded-md
                                  border-gray-300 px-3 text-sm">

                </div>

                <!-- Año de finalización -->
                <div>

                    <label for="periodo_fin"
                           class="mb-1 block text-xs font-medium text-gray-500">
                        Año de finalización
                    </label>

                    <input type="number"
                           id="periodo_fin"
                           name="periodo_fin"
                           min="2000"
                           max="2100"
                           value="{{ old(
                                'periodo_fin',
                                $metaActual?->periodo_fin ?? ''
                           ) }}"
                           required
                           class="h-10 w-full min-w-0 rounded-md
                                  border-gray-300 px-3 text-sm">

                </div>

            </div>

        </div>

        <!-- Responsable -->
        <div class="flex min-w-0 items-center gap-4">

            <label for="responsable_id"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Responsable
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="responsable_id"
                        name="responsable_id"
                        required
                        class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                    <option value="">
                        Seleccione un responsable
                    </option>

                    @foreach($responsables as $responsable)

                        <option value="{{ $responsable->id }}"
                            {{ (string) old(
                                'responsable_id',
                                $metaActual?->responsable_id ?? ''
                            ) === (string) $responsable->id
                                ? 'selected'
                                : '' }}>

                            {{ $responsable->nombres }}
                            {{ $responsable->apellidos }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

    </div>

</div>

@if(!$esContextoAsistente)

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const planSelect =
                document.getElementById('plan_id');

            const objetivoSelect =
                document.getElementById('objetivo_id');

            const objetivos =
                {{ Illuminate\Support\Js::from($datosObjetivos) }};

            const objetivoInicial =
                @json((string) $objetivoInicial);

            function agregarOpcion(
                valor,
                texto
            ) {
                const opcion =
                    document.createElement('option');

                opcion.value = valor;
                opcion.textContent = texto;

                objetivoSelect.appendChild(opcion);

                return opcion;
            }

            function cargarObjetivos(
                planId,
                objetivoSeleccionado = ''
            ) {
                objetivoSelect.innerHTML = '';

                if (!planId) {
                    objetivoSelect.disabled = true;

                    agregarOpcion(
                        '',
                        'Seleccione un plan primero'
                    );

                    return;
                }

                const objetivosFiltrados = objetivos.filter(
                    objetivo =>
                        String(objetivo.plan_id) ===
                        String(planId)
                );

                if (objetivosFiltrados.length === 0) {
                    objetivoSelect.disabled = true;

                    agregarOpcion(
                        '',
                        'No existen objetivos activos para este plan'
                    );

                    return;
                }

                objetivoSelect.disabled = false;

                agregarOpcion(
                    '',
                    'Seleccione un objetivo'
                );

                objetivosFiltrados.forEach(objetivo => {
                    const opcion = agregarOpcion(
                        objetivo.id,
                        `${objetivo.codigo} - ${objetivo.nombre}`
                    );

                    opcion.selected =
                        String(objetivo.id) ===
                        String(objetivoSeleccionado);
                });
            }

            planSelect.addEventListener('change', function () {
                cargarObjetivos(
                    this.value
                );
            });

            cargarObjetivos(
                planSelect.value,
                objetivoInicial
            );
        });
    </script>

@endif