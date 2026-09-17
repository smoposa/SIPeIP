@php
    $indicadorActual = $indicador ?? null;

    $esContextoAsistente =
        !$indicadorActual &&
        !empty($planSeleccionado) &&
        !empty($objetivoSeleccionado) &&
        !empty($metaSeleccionada);

    $planInicial = old(
        'plan_id',
        $indicadorActual?->meta?->objetivo?->plan_id ?? ''
    );

    $objetivoInicial = old(
        'objetivo_id',
        $indicadorActual?->meta?->objetivo_id ?? ''
    );

    $metaInicial = old(
        'meta_id',
        $indicadorActual?->meta_id ?? ''
    );

    $datosObjetivos = $objetivos
        ->map(
            fn ($objetivo) => [
                'id' => (string) $objetivo->id,
                'plan_id' => (string) $objetivo->plan_id,
                'codigo' => $objetivo->codigo,
                'nombre' => $objetivo->nombre,
            ]
        )
        ->values();

    $datosMetas = $metas
        ->map(
            fn ($meta) => [
                'id' => (string) $meta->id,
                'objetivo_id' => (string) $meta->objetivo_id,
                'codigo' => $meta->codigo,
                'nombre' => $meta->nombre,
            ]
        )
        ->values();

    $tiposIndicador = [
        'Resultado',
        'Producto',
        'Gestión',
        'Proceso',
        'Impacto',
    ];

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

    $frecuencias = [
        'Mensual',
        'Bimestral',
        'Trimestral',
        'Cuatrimestral',
        'Semestral',
        'Anual',
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

        <!-- Selectores para ingreso directo o edición -->
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

                </div>

            </div>

            <!-- Meta institucional -->
            <div class="mb-5 flex min-w-0 items-start gap-4">

                <label for="meta_id"
                       class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                    Meta institucional
                    <span class="text-red-500">*</span>

                </label>

                <div class="min-w-0 flex-1">

                    <select id="meta_id"
                            name="meta_id"
                            required
                            disabled
                            class="h-10 w-full min-w-0 rounded-md border-gray-300
                                   px-3 text-sm disabled:cursor-not-allowed
                                   disabled:bg-gray-100">

                        <option value="">
                            Seleccione un objetivo primero
                        </option>

                    </select>

                </div>

            </div>

        @endif

        <!-- Código -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="codigo"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Código del indicador

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="codigo"
                       value="{{ $indicadorActual?->codigo ?? $codigo ?? '' }}"
                       readonly
                       class="h-10 w-full min-w-0 cursor-not-allowed
                              rounded-md border-gray-300 bg-gray-100
                              px-3 text-sm text-gray-600">

            </div>

        </div>

        <!-- Nombre -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="nombre"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Nombre del indicador
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="nombre"
                       name="nombre"
                       maxlength="255"
                       value="{{ old('nombre', $indicadorActual?->nombre ?? '') }}"
                       required
                       placeholder="Ingrese el nombre del indicador"
                       class="h-10 w-full min-w-0 rounded-md border-gray-300
                              px-3 text-sm focus:border-blue-500
                              focus:ring-blue-500">

            </div>

        </div>

        <!-- Tipo -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="tipo"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Tipo de indicador
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="tipo"
                        name="tipo"
                        required
                        class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                    <option value="">
                        Seleccione un tipo
                    </option>

                    @foreach($tiposIndicador as $opcionTipo)

                        <option value="{{ $opcionTipo }}"
                            {{ old(
                                'tipo',
                                $indicadorActual?->tipo ?? ''
                            ) === $opcionTipo ? 'selected' : '' }}>

                            {{ $opcionTipo }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <!-- Fórmula -->
        <div class="mb-5 flex min-w-0 items-start gap-4">

            <label for="formula"
                   class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                Fórmula
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <textarea id="formula"
                          name="formula"
                          rows="4"
                          required
                          placeholder="Ingrese la fórmula del indicador"
                          class="w-full min-w-0 rounded-md border-gray-300
                                 px-3 py-2 text-sm focus:border-blue-500
                                 focus:ring-blue-500">{{ old('formula', $indicadorActual?->formula ?? '') }}</textarea>

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
                                $indicadorActual?->unidad_medida ?? ''
                            ) === $valor ? 'selected' : '' }}>

                            {{ $etiqueta }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <!-- Frecuencia -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="frecuencia"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Frecuencia de medición
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="frecuencia"
                        name="frecuencia"
                        required
                        class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                    <option value="">
                        Seleccione una frecuencia
                    </option>

                    @foreach($frecuencias as $opcionFrecuencia)

                        <option value="{{ $opcionFrecuencia }}"
                            {{ old(
                                'frecuencia',
                                $indicadorActual?->frecuencia ?? ''
                            ) === $opcionFrecuencia ? 'selected' : '' }}>

                            {{ $opcionFrecuencia }}

                        </option>

                    @endforeach

                </select>

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
                                $indicadorActual?->responsable_id ?? ''
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

            const metaSelect =
                document.getElementById('meta_id');

            const objetivos =
                {{ Illuminate\Support\Js::from($datosObjetivos) }};

            const metas =
                {{ Illuminate\Support\Js::from($datosMetas) }};

            const objetivoInicial =
                @json((string) $objetivoInicial);

            const metaInicial =
                @json((string) $metaInicial);

            function agregarOpcion(
                select,
                valor,
                texto
            ) {
                const opcion =
                    document.createElement('option');

                opcion.value = valor;
                opcion.textContent = texto;

                select.appendChild(opcion);

                return opcion;
            }

            function reiniciarMetas() {
                metaSelect.innerHTML = '';
                metaSelect.disabled = true;

                agregarOpcion(
                    metaSelect,
                    '',
                    'Seleccione un objetivo primero'
                );
            }

            function cargarObjetivos(
                planId,
                objetivoSeleccionado = ''
            ) {
                objetivoSelect.innerHTML = '';
                reiniciarMetas();

                if (!planId) {
                    objetivoSelect.disabled = true;

                    agregarOpcion(
                        objetivoSelect,
                        '',
                        'Seleccione un plan primero'
                    );

                    return;
                }

                const objetivosFiltrados = objetivos.filter(
                    objetivo =>
                        objetivo.plan_id === String(planId)
                );

                if (objetivosFiltrados.length === 0) {
                    objetivoSelect.disabled = true;

                    agregarOpcion(
                        objetivoSelect,
                        '',
                        'No existen objetivos activos para este plan'
                    );

                    return;
                }

                objetivoSelect.disabled = false;

                agregarOpcion(
                    objetivoSelect,
                    '',
                    'Seleccione un objetivo'
                );

                objetivosFiltrados.forEach(objetivo => {
                    const opcion = agregarOpcion(
                        objetivoSelect,
                        objetivo.id,
                        `${objetivo.codigo} - ${objetivo.nombre}`
                    );

                    opcion.selected =
                        objetivo.id ===
                        String(objetivoSeleccionado);
                });
            }

            function cargarMetas(
                objetivoId,
                metaSeleccionada = ''
            ) {
                metaSelect.innerHTML = '';

                if (!objetivoId) {
                    metaSelect.disabled = true;

                    agregarOpcion(
                        metaSelect,
                        '',
                        'Seleccione un objetivo primero'
                    );

                    return;
                }

                const metasFiltradas = metas.filter(
                    meta =>
                        meta.objetivo_id === String(objetivoId)
                );

                if (metasFiltradas.length === 0) {
                    metaSelect.disabled = true;

                    agregarOpcion(
                        metaSelect,
                        '',
                        'No existen metas activas para este objetivo'
                    );

                    return;
                }

                metaSelect.disabled = false;

                agregarOpcion(
                    metaSelect,
                    '',
                    'Seleccione una meta'
                );

                metasFiltradas.forEach(meta => {
                    const opcion = agregarOpcion(
                        metaSelect,
                        meta.id,
                        `${meta.codigo} - ${meta.nombre}`
                    );

                    opcion.selected =
                        meta.id ===
                        String(metaSeleccionada);
                });
            }

            planSelect.addEventListener('change', function () {
                cargarObjetivos(
                    this.value
                );
            });

            objetivoSelect.addEventListener('change', function () {
                cargarMetas(
                    this.value
                );
            });

            cargarObjetivos(
                planSelect.value,
                objetivoInicial
            );

            if (objetivoInicial) {
                cargarMetas(
                    objetivoInicial,
                    metaInicial
                );
            }
        });
    </script>

@endif