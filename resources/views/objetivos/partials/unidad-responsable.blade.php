<!-- Unidad Responsable -->
<div class="mb-8">

    <!-- Encabezado -->
    <div class="bg-[#F3F2F1] border-b border-gray-200 px-4 py-2 mb-5">

        <h2 class="text-sm font-semibold text-gray-700">
            Unidad Responsable
        </h2>

    </div>

    <!-- Contenido -->
    <div class="pl-8">

        <div class="flex items-center">

            <label for="unidad_responsable_id"
                   class="w-52 text-sm font-semibold text-gray-700">
                Unidad Responsable
                <span class="text-red-500">*</span>
            </label>

            <select
                id="unidad_responsable_id"
                name="unidad_responsable_id"
                class="flex-1 rounded-lg border-gray-300">

                <option value="">
                    Seleccione
                </option>

    {{--
    @foreach($unidades as $unidad)

        <option value="{{ $unidad->id }}"
            {{ old('unidad_responsable_id') == $unidad->id ? 'selected' : '' }}>

            {{ $unidad->nombre }}

        </option>

    @endforeach
    --}}

<option value="">Seleccione</option>
<option value="1">Dirección Nacional de Atención Integral</option>
<option value="2">Dirección Nacional de Planificación</option>
<option value="3">Coordinación General de Salud</option>

            </select>

        </div>

    </div>

</div>