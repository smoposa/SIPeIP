{{-- ================= INFORMACIÓN GENERAL ================= --}}
<div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">

    <h3 class="text-lg font-semibold text-gray-800 mb-5">
        Información general
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Código -->
        <div>

            <label class="block text-sm font-medium text-gray-700 mb-1">
                Código
            </label>

            <input type="text"
                value="{{ $programa->codigo ?? $codigo }}"
                class="w-full rounded-md border-gray-300 bg-gray-100 text-gray-600 shadow-sm"
                readonly>

        </div>

        <!-- Responsable -->
        <div>

            <label for="responsable_id"
                class="block text-sm font-medium text-gray-700 mb-1">

                Responsable
                <span class="text-red-500">*</span>

            </label>

            <select
                id="responsable_id"
                name="responsable_id"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <option value="">
                    Seleccione...
                </option>

                @foreach($responsables as $responsable)

                    <option value="{{ $responsable->id }}"
                        {{ old('responsable_id', $programa->responsable_id ?? '') == $responsable->id ? 'selected' : '' }}

                        {{ $responsable->nombres }}
                        {{ $responsable->apellidos }}

                    </option>

                @endforeach

            </select>

            @error('responsable_id')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Nombre -->
        <div class="md:col-span-2">

            <label for="nombre"
                class="block text-sm font-medium text-gray-700 mb-1">

                Nombre del programa
                <span class="text-red-500">*</span>

            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre', $programa->nombre ?? '') }}"
                maxlength="255"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('nombre')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Descripción -->
        <div class="md:col-span-2">

            <label for="descripcion"
                class="block text-sm font-medium text-gray-700 mb-1">

                Descripción

            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                rows="4"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                {{ old('descripcion', $programa->descripcion ?? '') }}
            </textarea>

            @error('descripcion')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Período inicio -->
        <div>

            <label for="periodo_inicio"
                class="block text-sm font-medium text-gray-700 mb-1">

                Período inicio
                <span class="text-red-500">*</span>

            </label>

            <input
                type="number"
                id="periodo_inicio"
                name="periodo_inicio"
                value="{{ old('periodo_inicio', $programa->periodo_inicio ?? '') }}"
                min="2000"
                max="2100"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('periodo_inicio')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Período fin -->
        <div>

            <label for="periodo_fin"
                class="block text-sm font-medium text-gray-700 mb-1">

                Período fin
                <span class="text-red-500">*</span>

            </label>

            <input
                type="number"
                id="periodo_fin"
                name="periodo_fin"
                value="{{ old('periodo_fin', $programa->periodo_fin ?? '') }}"
                min="2000"
                max="2100"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('periodo_fin')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

    </div>

    <!-- Objetivos -->
    <div class="mt-6">

        <label
            class="block text-sm font-medium text-gray-700 mb-2">

            Objetivos Estratégicos Institucionales (OEI)
            <span class="text-red-500">*</span>

        </label>

        <div class="border border-gray-300 rounded-md p-4 max-h-72 overflow-y-auto">

            @foreach($objetivos as $objetivo)

                <label class="flex items-start gap-3 py-2 border-b border-gray-100 last:border-b-0">

                    <input
                        type="checkbox"
                        name="objetivos[]"
                        value="{{ $objetivo->id }}"
                        {{
                            in_array(
                                $objetivo->id,
                                old(
                                    'objetivos',
                                    isset($programa)
                                        ? $programa->objetivos->pluck('id')->toArray()
                                        : []
                                )
                            )
                                ? 'checked'
                                : ''
                        }}
                        class="mt-1 rounded border-gray-300 text-blue-600 focus:ring-blue-500">

                    <div>

                        <p class="text-sm font-medium text-gray-800">

                            {{ $objetivo->codigo }}

                        </p>

                        <p class="text-sm text-gray-600">

                            {{ $objetivo->nombre }}

                        </p>

                    </div>

                </label>

            @endforeach

        </div>

        @error('objetivos')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>

</div>