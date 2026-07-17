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

        {{-- Meta (solo cuando NO viene desde el asistente) --}}
        @if(!$metaSeleccionada)

            <div class="flex items-center mb-5">

                <label for="meta_id"
                       class="w-52 text-sm font-semibold text-gray-700">
                    Meta Institucional
                    <span class="text-red-500">*</span>
                </label>

                <select
                    id="meta_id"
                    name="meta_id"
                    class="flex-1 rounded-lg border-gray-300">

                    <option value="">Seleccione una meta</option>

                    @foreach($metas as $meta)

                        <option value="{{ $meta->id }}"
                            {{ old('meta_id') == $meta->id ? 'selected' : '' }}>

                            {{ $meta->codigo }} - {{ $meta->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

        @else

            {{-- Mantener la meta seleccionada --}}
            <input type="hidden"
                   name="meta_id"
                   value="{{ $metaSeleccionada->id }}">

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
                Nombre del Indicador
                <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre') }}"
                class="flex-1 rounded-lg border-gray-300">

        </div>

        <!-- Tipo -->
        <div class="flex items-center mb-5">

            <label for="tipo"
                   class="w-52 text-sm font-semibold text-gray-700">
                Tipo
                <span class="text-red-500">*</span>
            </label>

            <select
                id="tipo"
                name="tipo"
                class="flex-1 rounded-lg border-gray-300">

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

        <!-- Fórmula -->
        <div class="flex items-start mb-5">

            <label for="formula"
                   class="w-52 text-sm font-semibold text-gray-700 pt-3">
                Fórmula
                <span class="text-red-500">*</span>
            </label>

            <textarea
                id="formula"
                name="formula"
                rows="4"
                class="flex-1 rounded-lg border-gray-300">{{ old('formula') }}</textarea>

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

        <!-- Frecuencia de Medición -->
        <div class="flex items-center mb-5">

            <label for="frecuencia"
                   class="w-52 text-sm font-semibold text-gray-700">
                Frecuencia de Medición
                <span class="text-red-500">*</span>
            </label>

            <select
                id="frecuencia"
                name="frecuencia"
                class="flex-1 rounded-lg border-gray-300">

                <option value="">Seleccione una frecuencia</option>

                <option value="Mensual" {{ old('frecuencia') == 'Mensual' ? 'selected' : '' }}>
                    Mensual
                </option>

                <option value="Bimestral" {{ old('frecuencia') == 'Bimestral' ? 'selected' : '' }}>
                    Bimestral
                </option>

                <option value="Trimestral" {{ old('frecuencia') == 'Trimestral' ? 'selected' : '' }}>
                    Trimestral
                </option>

                <option value="Cuatrimestral" {{ old('frecuencia') == 'Cuatrimestral' ? 'selected' : '' }}>
                    Cuatrimestral
                </option>

                <option value="Semestral" {{ old('frecuencia') == 'Semestral' ? 'selected' : '' }}>
                    Semestral
                </option>

                <option value="Anual" {{ old('frecuencia') == 'Anual' ? 'selected' : '' }}>
                    Anual
                </option>

            </select>

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