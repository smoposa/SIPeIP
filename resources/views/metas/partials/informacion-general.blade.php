<!-- Información general -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información General
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        {{-- Objetivo cuando no viene seleccionado desde el asistente --}}
        @if(!$objetivoSeleccionado)

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
                            class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                        <option value="">Seleccione un objetivo</option>

                        @foreach($objetivos as $objetivo)

                            <option value="{{ $objetivo->id }}"
                                {{ old('objetivo_id') == $objetivo->id ? 'selected' : '' }}>

                                {{ $objetivo->codigo }} - {{ $objetivo->nombre }}

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

                Nombre de la meta
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="nombre"
                       name="nombre"
                       maxlength="255"
                       value="{{ old('nombre') }}"
                       required
                       class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

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
                          class="w-full min-w-0 rounded-md border-gray-300 px-3 py-2 text-sm">{{ old('descripcion') }}</textarea>

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
                       value="{{ old('linea_base') }}"
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
                       value="{{ old('valor_meta') }}"
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

                    <option value="">Seleccione una unidad</option>

                    <option value="Porcentaje"
                        {{ old('unidad_medida') == 'Porcentaje' ? 'selected' : '' }}>
                        Porcentaje (%)
                    </option>

                    <option value="Número"
                        {{ old('unidad_medida') == 'Número' ? 'selected' : '' }}>
                        Número
                    </option>

                    <option value="Personas"
                        {{ old('unidad_medida') == 'Personas' ? 'selected' : '' }}>
                        Personas
                    </option>

                    <option value="Beneficiarios"
                        {{ old('unidad_medida') == 'Beneficiarios' ? 'selected' : '' }}>
                        Beneficiarios
                    </option>

                    <option value="Centros de Salud"
                        {{ old('unidad_medida') == 'Centros de Salud' ? 'selected' : '' }}>
                        Centros de salud
                    </option>

                    <option value="Hospitales"
                        {{ old('unidad_medida') == 'Hospitales' ? 'selected' : '' }}>
                        Hospitales
                    </option>

                    <option value="Establecimientos"
                        {{ old('unidad_medida') == 'Establecimientos' ? 'selected' : '' }}>
                        Establecimientos
                    </option>

                    <option value="Kilómetros"
                        {{ old('unidad_medida') == 'Kilómetros' ? 'selected' : '' }}>
                        Kilómetros
                    </option>

                    <option value="Metros cuadrados"
                        {{ old('unidad_medida') == 'Metros cuadrados' ? 'selected' : '' }}>
                        Metros cuadrados
                    </option>

                    <option value="Documentos"
                        {{ old('unidad_medida') == 'Documentos' ? 'selected' : '' }}>
                        Documentos
                    </option>

                    <option value="Procesos"
                        {{ old('unidad_medida') == 'Procesos' ? 'selected' : '' }}>
                        Procesos
                    </option>

                    <option value="Capacitaciones"
                        {{ old('unidad_medida') == 'Capacitaciones' ? 'selected' : '' }}>
                        Capacitaciones
                    </option>

                    <option value="Minutos"
                        {{ old('unidad_medida') == 'Minutos' ? 'selected' : '' }}>
                        Minutos
                    </option>

                    <option value="Horas"
                        {{ old('unidad_medida') == 'Horas' ? 'selected' : '' }}>
                        Horas
                    </option>

                    <option value="Días"
                        {{ old('unidad_medida') == 'Días' ? 'selected' : '' }}>
                        Días
                    </option>

                    <option value="Meses"
                        {{ old('unidad_medida') == 'Meses' ? 'selected' : '' }}>
                        Meses
                    </option>

                    <option value="Años"
                        {{ old('unidad_medida') == 'Años' ? 'selected' : '' }}>
                        Años
                    </option>

                    <option value="Unidades"
                        {{ old('unidad_medida') == 'Unidades' ? 'selected' : '' }}>
                        Unidades
                    </option>

                    <option value="Otro"
                        {{ old('unidad_medida') == 'Otro' ? 'selected' : '' }}>
                        Otro
                    </option>

                </select>

            </div>

        </div>

        <!-- Período de vigencia -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Período de vigencia
                <span class="text-red-500">*</span>

            </span>

            <div class="flex min-w-0 flex-1 items-center gap-3">

                <div class="min-w-0 flex-1">

                    <label for="periodo_inicio" class="sr-only">
                        Año de inicio
                    </label>

                    <input type="number"
                           id="periodo_inicio"
                           name="periodo_inicio"
                           min="2000"
                           max="2100"
                           placeholder="Año inicial"
                           value="{{ old('periodo_inicio') }}"
                           required
                           class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                </div>

                <span class="flex-shrink-0 font-semibold text-gray-500">
                    -
                </span>

                <div class="min-w-0 flex-1">

                    <label for="periodo_fin" class="sr-only">
                        Año de finalización
                    </label>

                    <input type="number"
                           id="periodo_fin"
                           name="periodo_fin"
                           min="2000"
                           max="2100"
                           placeholder="Año final"
                           value="{{ old('periodo_fin') }}"
                           required
                           class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

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