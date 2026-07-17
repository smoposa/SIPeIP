<!-- Información General -->
<div class="mb-8">

    <!-- Encabezado -->
    <div class="bg-[#F3F2F1] border-b border-gray-200 px-4 py-2 mb-5">

        <h2 class="text-sm font-semibold text-gray-700">
            Información General
        </h2>

    </div>

    <!-- Contenido -->
    <div class="pl-8">

        {{-- Objetivo (solo cuando NO viene desde el asistente) --}}
        @if(!$objetivoSeleccionado)

            <div class="flex items-center mb-5">

                <label for="objetivo_id"
                       class="w-52 text-sm font-semibold text-gray-700">
                    Objetivo Estratégico
                    <span class="text-red-500">*</span>
                </label>

                <select
                    id="objetivo_id"
                    name="objetivo_id"
                    class="flex-1 rounded-lg border-gray-300">

                    <option value="">Seleccione un objetivo</option>

                    @foreach($objetivos as $objetivo)

                        <option value="{{ $objetivo->id }}"
                            {{ old('objetivo_id') == $objetivo->id ? 'selected' : '' }}>

                            {{ $objetivo->codigo }} - {{ $objetivo->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

        @else

            {{-- Mantener el objetivo seleccionado --}}
            <input type="hidden"
                   name="objetivo_id"
                   value="{{ $objetivoSeleccionado->id }}">

        @endif


        <!-- Código -->
        <div class="flex items-center mb-5">

            <label for="codigo"
                   class="w-52 text-sm font-semibold text-gray-700">
                Código
            </label>

            <input
                type="text"
                id="codigo"
                value="{{ $codigo }}"
                readonly
                class="flex-1 rounded-lg border-gray-300 bg-gray-100">

        </div>

        <!-- Nombre -->
        <div class="flex items-center mb-5">

            <label for="nombre"
                   class="w-52 text-sm font-semibold text-gray-700">
                Nombre de la Meta
                <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre') }}"
                class="flex-1 rounded-lg border-gray-300">

        </div>

        <!-- Descripción -->
        <div class="flex items-start mb-5">

            <label for="descripcion"
                   class="w-52 text-sm font-semibold text-gray-700 pt-3">
                Descripción
            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                rows="4"
                class="flex-1 rounded-lg border-gray-300">{{ old('descripcion') }}</textarea>

        </div>

        <!-- Línea base -->
        <div class="flex items-center mb-5">

            <label for="linea_base"
                   class="w-52 text-sm font-semibold text-gray-700">
                Línea Base
                <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                step="0.01"
                id="linea_base"
                name="linea_base"
                value="{{ old('linea_base') }}"
                class="flex-1 rounded-lg border-gray-300">

        </div>

        <!-- Valor Meta -->
        <div class="flex items-center mb-5">

            <label for="valor_meta"
                   class="w-52 text-sm font-semibold text-gray-700">
                Valor Meta
                <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                step="0.01"
                id="valor_meta"
                name="valor_meta"
                value="{{ old('valor_meta') }}"
                class="flex-1 rounded-lg border-gray-300">

        </div>

        <!-- Unidad de Medida -->
        <div class="flex items-center mb-5">

            <label for="unidad_medida"
                class="w-52 text-sm font-semibold text-gray-700">
                Unidad de Medida
                <span class="text-red-500">*</span>
            </label>

            <select
                id="unidad_medida"
                name="unidad_medida"
                class="flex-1 rounded-lg border-gray-300">

                <option value="">Seleccione una unidad</option>

                <option value="Porcentaje" {{ old('unidad_medida') == 'Porcentaje' ? 'selected' : '' }}>
                    Porcentaje (%)
                </option>

                <option value="Número" {{ old('unidad_medida') == 'Número' ? 'selected' : '' }}>
                    Número
                </option>

                <option value="Personas" {{ old('unidad_medida') == 'Personas' ? 'selected' : '' }}>
                    Personas
                </option>

                <option value="Beneficiarios" {{ old('unidad_medida') == 'Beneficiarios' ? 'selected' : '' }}>
                    Beneficiarios
                </option>

                <option value="Centros de Salud" {{ old('unidad_medida') == 'Centros de Salud' ? 'selected' : '' }}>
                    Centros de Salud
                </option>

                <option value="Hospitales" {{ old('unidad_medida') == 'Hospitales' ? 'selected' : '' }}>
                    Hospitales
                </option>

                <option value="Establecimientos" {{ old('unidad_medida') == 'Establecimientos' ? 'selected' : '' }}>
                    Establecimientos
                </option>

                <option value="Kilómetros" {{ old('unidad_medida') == 'Kilómetros' ? 'selected' : '' }}>
                    Kilómetros
                </option>

                <option value="Metros cuadrados" {{ old('unidad_medida') == 'Metros cuadrados' ? 'selected' : '' }}>
                    Metros cuadrados
                </option>

                <option value="Documentos" {{ old('unidad_medida') == 'Documentos' ? 'selected' : '' }}>
                    Documentos
                </option>

                <option value="Procesos" {{ old('unidad_medida') == 'Procesos' ? 'selected' : '' }}>
                    Procesos
                </option>

                <option value="Capacitaciones" {{ old('unidad_medida') == 'Capacitaciones' ? 'selected' : '' }}>
                    Capacitaciones
                </option>

                <option value="Minutos" {{ old('unidad_medida') == 'Minutos' ? 'selected' : '' }}>
                    Minutos
                </option>

                <option value="Horas" {{ old('unidad_medida') == 'Horas' ? 'selected' : '' }}>
                    Horas
                </option>

                <option value="Días" {{ old('unidad_medida') == 'Días' ? 'selected' : '' }}>
                    Días
                </option>

                <option value="Meses" {{ old('unidad_medida') == 'Meses' ? 'selected' : '' }}>
                    Meses
                </option>

                <option value="Años" {{ old('unidad_medida') == 'Años' ? 'selected' : '' }}>
                    Años
                </option>

                <option value="Unidades" {{ old('unidad_medida') == 'Unidades' ? 'selected' : '' }}>
                    Unidades
                </option>

                <option value="Otro" {{ old('unidad_medida') == 'Otro' ? 'selected' : '' }}>
                    Otro
                </option>

            </select>

        </div>

        <!-- Período de Vigencia -->
        <div class="flex items-center mb-5">

            <label class="w-52 text-sm font-semibold text-gray-700">
                Período de Vigencia
                <span class="text-red-500">*</span>
            </label>

            <div class="flex items-center gap-3">

                <!-- Año Inicio -->
                <input
                    type="number"
                    id="periodo_inicio"
                    name="periodo_inicio"
                    min="2000"
                    max="2100"
                    placeholder="2025"
                    value="{{ old('periodo_inicio') }}"
                    class="w-28 rounded-lg border-gray-300">

                <span class="text-gray-500 font-semibold">
                    -
                </span>

                <!-- Año Fin -->
                <input
                    type="number"
                    id="periodo_fin"
                    name="periodo_fin"
                    min="2000"
                    max="2100"
                    placeholder="2028"
                    value="{{ old('periodo_fin') }}"
                    class="w-28 rounded-lg border-gray-300">

            </div>

        </div>

        <!-- Responsable -->
        <div class="flex items-center">

            <label for="responsable_id"
                class="w-52 text-sm font-semibold text-gray-700">
                Responsable
                <span class="text-red-500">*</span>
            </label>

            <select
                id="responsable_id"
                name="responsable_id"
                class="flex-1 rounded-lg border-gray-300">

                <option value="">Seleccione un responsable</option>

                @foreach($responsables as $responsable)

                    <option value="{{ $responsable->id }}"
                        {{ old('responsable_id') == $responsable->id ? 'selected' : '' }}>

                        {{ $responsable->nombres }} {{ $responsable->apellidos }}

                    </option>

                @endforeach

            </select>

        </div>

    </div>

</div>