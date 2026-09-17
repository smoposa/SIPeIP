<!-- Información general -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información general
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        <!--
            El selector se muestra solamente cuando el usuario
            ingresa directamente desde el módulo de Objetivos.
        -->
        @if(!$planSeleccionado)

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
                                    {{ (string) old('plan_id') === (string) $plan->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $plan->codigo }} - {{ $plan->nombre }}

                                </option>

                            @endforeach

                        @endif

                    </select>

                    <p class="mt-1 text-xs text-gray-500">
                        El objetivo quedará asociado al plan institucional seleccionado.
                    </p>

                </div>

            </div>

        @endif

        <!-- Código -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="codigo"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Código del objetivo

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

                Nombre del objetivo
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="nombre"
                       name="nombre"
                       maxlength="255"
                       value="{{ old('nombre') }}"
                       required
                       placeholder="Ingrese el nombre del objetivo"
                       class="h-10 w-full min-w-0 rounded-md border-gray-300
                              px-3 text-sm focus:border-blue-500
                              focus:ring-blue-500">

            </div>

        </div>

        <!-- Descripción -->
        <div class="flex min-w-0 items-start gap-4">

            <label for="descripcion"
                   class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                Descripción

            </label>

            <div class="min-w-0 flex-1">

                <textarea id="descripcion"
                          name="descripcion"
                          rows="4"
                          maxlength="1000"
                          placeholder="Ingrese una descripción del objetivo"
                          class="w-full min-w-0 rounded-md border-gray-300
                                 px-3 py-2 text-sm focus:border-blue-500
                                 focus:ring-blue-500">{{ old('descripcion') }}</textarea>

            </div>

        </div>

    </div>

</div>