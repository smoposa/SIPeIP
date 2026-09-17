<!-- Información General -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información General
        </h2>

    </div>

    <div class="pl-8">

        {{-- Plan cuando no viene seleccionado desde el asistente --}}
        @if(!$planSeleccionado)

            <div class="mb-5 flex items-center gap-4">

                <label for="plan_id"
                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                    Plan
                    <span class="text-red-500">*</span>

                </label>

                <div class="min-w-0 flex-1">

                    <select id="plan_id"
                            name="plan_id"
                            required
                            class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

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

        @endif

        <!-- Código -->
        <div class="mb-5 flex items-center gap-4">

            <label for="codigo"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Código

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="codigo"
                       value="{{ $codigo }}"
                       readonly
                       class="h-10 w-full min-w-0 cursor-not-allowed rounded-md border-gray-300 bg-gray-100 px-3 text-sm text-gray-600">

            </div>

        </div>

        <!-- Nombre -->
        <div class="mb-5 flex items-center gap-4">

            <label for="nombre"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Nombre del Objetivo
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
        <div class="flex items-start gap-4">

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

    </div>

</div>