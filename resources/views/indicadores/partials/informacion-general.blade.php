<!-- Información general -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información General
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        {{-- Meta cuando no viene seleccionada desde el asistente --}}
        @if(!$metaSeleccionada)

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
                            class="h-10 w-full min-w-0 rounded-md
                                   border-gray-300 px-3 text-sm">

                        <option value="">Seleccione una meta</option>

                        @foreach($metas as $meta)

                            <option value="{{ $meta->id }}"
                                {{ old('meta_id') == $meta->id ? 'selected' : '' }}>

                                {{ $meta->codigo }} - {{ $meta->nombre }}

                            </option>

                        @endforeach

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
                       class="h-10 w-full min-w-0 cursor-not-allowed rounded-md
                              border-gray-300 bg-gray-100 px-3 text-sm text-gray-600">

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

                    <option value="Resultado"
                        {{ old('tipo') == 'Resultado' ? 'selected' : '' }}>
                        Resultado
                    </option>

                    <option value="Producto"
                        {{ old('tipo') == 'Producto' ? 'selected' : '' }}>
                        Producto
                    </option>

                    <option value="Gestión"
                        {{ old('tipo') == 'Gestión' ? 'selected' : '' }}>
                        Gestión
                    </option>

                    <option value="Impacto"
                        {{ old('tipo') == 'Impacto' ? 'selected' : '' }}>
                        Impacto
                    </option>

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