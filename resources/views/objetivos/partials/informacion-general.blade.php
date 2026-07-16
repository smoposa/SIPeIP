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

        {{-- Plan (solo cuando NO viene desde el asistente) --}}
        @if(!$planSeleccionado)

            <div class="flex items-center mb-5">

                <label for="plan_id"
                       class="w-52 text-sm font-semibold text-gray-700">
                    Plan
                    <span class="text-red-500">*</span>
                </label>

                <select
                    id="plan_id"
                    name="plan_id"
                    class="flex-1 rounded-lg border-gray-300">

                    <option value="">Seleccione un plan</option>

                    @foreach($planes as $plan)

                        <option value="{{ $plan->id }}"
                            {{ old('plan_id') == $plan->id ? 'selected' : '' }}>

                            {{ $plan->codigo }} - {{ $plan->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

        @endif

        <!-- Código -->
        <div class="flex items-center mb-5">

            <label for="codigo"
                   class="w-52 text-sm font-semibold text-gray-700">
                Código
            </label>

            <input type="text"
                   id="codigo"
                   value="{{ $codigo }}"
                   readonly
                   class="flex-1 rounded-lg border-gray-300 bg-gray-100">

        </div>

        <!-- Nombre -->
        <div class="flex items-center mb-5">

            <label for="nombre"
                   class="w-52 text-sm font-semibold text-gray-700">
                Nombre del Objetivo
                <span class="text-red-500">*</span>
            </label>

            <input type="text"
                   id="nombre"
                   name="nombre"
                   value="{{ old('nombre') }}"
                   class="flex-1 rounded-lg border-gray-300">

        </div>

        <!-- Descripción -->
        <div class="flex items-start">

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

    </div>

</div>