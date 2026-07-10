<div class="space-y-4">

    <!-- Código -->
    <div class="flex items-center">

        <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">
            Código del Plan
        </label>

        <div class="w-2/3">

            @if(isset($plan))

                <input
                    type="text"
                    name="codigo"
                    value="{{ old('codigo', $plan->codigo) }}"
                    maxlength="30"
                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

            @else

                <input
                    type="text"
                    value="{{ $codigo }}"
                    readonly
                    class="w-full h-9 bg-gray-100 border border-gray-300 rounded-md px-3 text-sm text-gray-600 cursor-not-allowed">

            @endif

        </div>

    </div>

    <!-- Nombre -->
    <div class="flex items-center">

        <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">
            Nombre del Plan <span class="text-red-500">*</span>
        </label>

        <div class="w-2/3">

            <input
                type="text"
                name="nombre"
                maxlength="255"
                required
                value="{{ old('nombre', $plan->nombre ?? '') }}"
                placeholder="Ingrese el nombre del plan"
                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

        </div>

    </div>

    <!-- Entidad -->
    <div class="flex items-center">

        <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">
            Entidad
        </label>

        <div class="w-2/3">

            <input
                type="text"
                value="{{ auth()->user()->entidad->nombre }}"
                readonly
                class="w-full h-9 bg-gray-100 border border-gray-300 rounded-md px-3 text-sm text-gray-600 cursor-not-allowed">

            <input
                type="hidden"
                name="entidad_id"
                value="{{ auth()->user()->entidad_id }}">

        </div>

    </div>

    <!-- Tipo -->
    <div class="flex items-center">

        <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">
            Tipo
        </label>

        <div class="w-2/3">

            @if(isset($plan))

                <select
                    name="tipo"
                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

                    <option value="Plan Estratégico Institucional"
                        {{ old('tipo', $plan->tipo) == 'Plan Estratégico Institucional' ? 'selected' : '' }}>
                        Plan Estratégico Institucional
                    </option>

                </select>

            @else

                <input
                    type="text"
                    value="Plan Estratégico Institucional"
                    readonly
                    class="w-full h-9 bg-gray-100 border border-gray-300 rounded-md px-3 text-sm text-gray-600 cursor-not-allowed">

                <input
                    type="hidden"
                    name="tipo"
                    value="Plan Estratégico Institucional">

            @endif

        </div>

    </div>

    <!-- Período -->
    <div class="flex items-center">

        <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">
            Período <span class="text-red-500">*</span>
        </label>

        <div class="flex gap-3 items-center">

            <input
                type="number"
                name="periodo_inicio"
                min="2000"
                max="2100"
                required
                value="{{ old('periodo_inicio', $plan->periodo_inicio ?? '') }}"
                placeholder="2026"
                class="w-28 h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

            <span class="text-gray-500">-</span>

            <input
                type="number"
                name="periodo_fin"
                min="2000"
                max="2100"
                required
                value="{{ old('periodo_fin', $plan->periodo_fin ?? '') }}"
                placeholder="2029"
                class="w-28 h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

        </div>

    </div>

    <!-- Descripción -->
    <div class="flex items-start">

        <label class="w-44 flex-shrink-0 pt-2 text-sm font-medium text-gray-700">
            Descripción
        </label>

        <div class="w-2/3">

            <textarea
                name="descripcion"
                rows="4"
                maxlength="1000"
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Ingrese una descripción del plan...">{{ old('descripcion', $plan->descripcion ?? '') }}</textarea>

        </div>

    </div>

    <!-- Botones -->
    <div class="flex mt-6">

        <div class="w-44 flex-shrink-0"></div>

        <div class="w-2/3 flex justify-end gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                {{ isset($plan) ? 'Actualizar' : 'Guardar' }}

            </button>

            <a href="{{ route('planes.listar') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                Cancelar

            </a>

        </div>

    </div>

</div>