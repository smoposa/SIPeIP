<!-- Información general -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información General
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        {{-- Selección directa desde el módulo --}}
        @if(!$metaSeleccionada)

            <!-- Plan institucional -->
            <div class="mb-5 flex min-w-0 items-center gap-4">

                <label for="plan_id"
                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                    Plan institucional
                    <span class="text-red-500">*</span>

                </label>

                <div class="min-w-0 flex-1">

                    <select id="plan_id"
                            name="plan_id"
                            required
                            class="h-10 w-full min-w-0 rounded-md
                                   border-gray-300 px-3 text-sm">

                        <option value="">Seleccione un plan</option>

                        @foreach($planes as $plan)

                            <option value="{{ $plan->id }}"
                                {{ old('plan_id') == $plan->id ? 'selected' : '' }}>

                                {{ $plan->codigo }} - {{ $plan->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <!-- Objetivo estratégico -->
            <div class="mb-5 flex min-w-0 items-center gap-4">

                <label for="objetivo_id"
                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                    Objetivo estratégico
                    <span class="text-red-500">*</span>

                </label>

                <div class="min-w-0 flex-1">

                    <select id="objetivo_id"
                            name="objetivo_id"
                            required
                            disabled
                            class="h-10 w-full min-w-0 rounded-md
                                   border-gray-300 px-3 text-sm">

                        <option value="">
                            Seleccione un plan primero
                        </option>

                    </select>

                </div>

            </div>

            <!-- Meta institucional -->
            <div class="mb-5 flex min-w-0 items-center gap-4">

                <label for="meta_id"
                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                    Meta institucional
                    <span class="text-red-500">*</span>

                </label>

                <div class="min-w-0 flex-1">

                    <select id="meta_id"
                            name="meta_id"
                            required
                            disabled
                            class="h-10 w-full min-w-0 rounded-md
                                   border-gray-300 px-3 text-sm">

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

                Código

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="codigo"
                       value="{{ $codigo }}"
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
                       value="{{ old('nombre') }}"
                       required
                       class="h-10 w-full min-w-0 rounded-md
                              border-gray-300 px-3 text-sm">

            </div>

        </div>

        <!-- Tipo -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="tipo"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Tipo
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="tipo"
                        name="tipo"
                        required
                        class="h-10 w-full min-w-0 rounded-md
                               border-gray-300 px-3 text-sm">

                    <option value="">Seleccione un tipo</option>

                    @foreach([
                        'Resultado',
                        'Producto',
                        'Gestión',
                        'Proceso',
                        'Impacto',
                    ] as $tipo)

                        <option value="{{ $tipo }}"
                            {{ old('tipo') == $tipo ? 'selected' : '' }}>

                            {{ $tipo }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <!-- Fórmula -->
        <div class="mb-5 flex min-w-0 items-start gap-4">

            <label for="formula"
                   class="w-52 flex-shrink-0 pt-2
                          text-sm font-semibold text-gray-700">

                Fórmula
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <textarea id="formula"
                          name="formula"
                          rows="4"
                          required
                          class="w-full min-w-0 rounded-md
                                 border-gray-300 px-3 py-2 text-sm">{{ old('formula') }}</textarea>

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
                        class="h-10 w-full min-w-0 rounded-md
                               border-gray-300 px-3 text-sm">

                    <option value="">Seleccione una unidad</option>

                    @foreach([
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
                    ] as $valor => $etiqueta)

                        <option value="{{ $valor }}"
                            {{ old('unidad_medida') == $valor ? 'selected' : '' }}>

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
                        class="h-10 w-full min-w-0 rounded-md
                               border-gray-300 px-3 text-sm">

                    <option value="">Seleccione una frecuencia</option>

                    @foreach([
                        'Mensual',
                        'Bimestral',
                        'Trimestral',
                        'Cuatrimestral',
                        'Semestral',
                        'Anual',
                    ] as $frecuencia)

                        <option value="{{ $frecuencia }}"
                            {{ old('frecuencia') == $frecuencia ? 'selected' : '' }}>

                            {{ $frecuencia }}

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
                        class="h-10 w-full min-w-0 rounded-md
                               border-gray-300 px-3 text-sm">

                    <option value="">Seleccione un responsable</option>

                    @foreach($responsables as $responsable)

                        <option value="{{ $responsable->id }}"
                            {{ old('responsable_id') == $responsable->id ? 'selected' : '' }}>

                            {{ $responsable->nombres }}
                            {{ $responsable->apellidos }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

    </div>

</div>

@if(!$metaSeleccionada)

    @php
        $opcionesPlanificacion = $metas->map(
            fn ($meta) => [
                'meta_id' => (string) $meta->id,
                'meta_codigo' => $meta->codigo,
                'meta_nombre' => $meta->nombre,

                'objetivo_id' => (string) $meta->objetivo?->id,
                'objetivo_codigo' => $meta->objetivo?->codigo,
                'objetivo_nombre' => $meta->objetivo?->nombre,

                'plan_id' => (string) $meta->objetivo?->plan?->id,
            ]
        )->values();
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const plan = document.getElementById('plan_id');
            const objetivo = document.getElementById('objetivo_id');
            const meta = document.getElementById('meta_id');

            if (!plan || !objetivo || !meta) {
                return;
            }

            const opciones =
                {{ Illuminate\Support\Js::from($opcionesPlanificacion) }};

            const planAnterior =
                @json((string) old('plan_id'));

            const objetivoAnterior =
                @json((string) old('objetivo_id'));

            const metaAnterior =
                @json((string) old('meta_id'));

            function agregarOpcion(
                select,
                valor,
                texto
            ) {
                const option = document.createElement('option');

                option.value = valor;
                option.textContent = texto;

                select.appendChild(option);
            }

            function cargarObjetivos(
                planId,
                seleccionado = ''
            ) {
                objetivo.innerHTML = '';
                meta.innerHTML = '';

                agregarOpcion(
                    meta,
                    '',
                    'Seleccione un objetivo primero'
                );

                meta.disabled = true;

                if (!planId) {
                    agregarOpcion(
                        objetivo,
                        '',
                        'Seleccione un plan primero'
                    );

                    objetivo.disabled = true;

                    return;
                }

                agregarOpcion(
                    objetivo,
                    '',
                    'Seleccione un objetivo'
                );

                const objetivosUnicos = new Map();

                opciones
                    .filter(item => item.plan_id === planId)
                    .forEach(item => {
                        objetivosUnicos.set(
                            item.objetivo_id,
                            {
                                codigo: item.objetivo_codigo,
                                nombre: item.objetivo_nombre,
                            }
                        );
                    });

                objetivosUnicos.forEach((datos, id) => {
                    agregarOpcion(
                        objetivo,
                        id,
                        `${datos.codigo} - ${datos.nombre}`
                    );
                });

                objetivo.disabled = false;
                objetivo.value = seleccionado;
            }

            function cargarMetas(
                objetivoId,
                seleccionada = ''
            ) {
                meta.innerHTML = '';

                if (!objetivoId) {
                    agregarOpcion(
                        meta,
                        '',
                        'Seleccione un objetivo primero'
                    );

                    meta.disabled = true;

                    return;
                }

                agregarOpcion(
                    meta,
                    '',
                    'Seleccione una meta'
                );

                opciones
                    .filter(
                        item =>
                            item.objetivo_id === objetivoId
                    )
                    .forEach(item => {
                        agregarOpcion(
                            meta,
                            item.meta_id,
                            `${item.meta_codigo} - ${item.meta_nombre}`
                        );
                    });

                meta.disabled = false;
                meta.value = seleccionada;
            }

            plan.addEventListener('change', function () {
                cargarObjetivos(this.value);
            });

            objetivo.addEventListener('change', function () {
                cargarMetas(this.value);
            });

            if (planAnterior) {
                plan.value = planAnterior;

                cargarObjetivos(
                    planAnterior,
                    objetivoAnterior
                );

                cargarMetas(
                    objetivoAnterior,
                    metaAnterior
                );
            }

        });
    </script>

@endif