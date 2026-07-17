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

            <input
                type="text"
                value="{{ $proyecto->codigo ?? $codigo }}"
                class="w-full rounded-md border-gray-300 bg-gray-100 text-gray-600 shadow-sm"
                readonly>

        </div>

        <!-- Programa -->
        <div>

            <label
                for="programa_id"
                class="block text-sm font-medium text-gray-700 mb-1">

                Programa
                <span class="text-red-500">*</span>

            </label>

            <select
                id="programa_id"
                name="programa_id"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <option value="">
                    Seleccione...
                </option>

                @foreach($programas as $programa)

                    <option
                        value="{{ $programa->id }}"
                        {{ old('programa_id', $proyecto->programa_id ?? session('programa_id')) == $programa->id ? 'selected' : '' }}>

                        {{ $programa->codigo }}

                        -

                        {{ $programa->nombre }}

                    </option>

                @endforeach

            </select>

            @error('programa_id')

                <p class="mt-1 text-sm text-red-600">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <!-- Responsable -->
        <div>

            <label
                for="responsable_id"
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

                    <option
                        value="{{ $responsable->id }}"
                        {{ old('responsable_id', $proyecto->responsable_id ?? '') == $responsable->id ? 'selected' : '' }}>

                        {{ $responsable->nombres }}
                        {{ $responsable->apellidos }}

                        @if($responsable->cargo)

                            - {{ $responsable->cargo }}

                        @endif

                    </option>

                @endforeach

            </select>

            @error('responsable_id')

                <p class="mt-1 text-sm text-red-600">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <!-- Presupuesto -->
        <div>

            <label
                for="presupuesto_aprobado"
                class="block text-sm font-medium text-gray-700 mb-1">

                Presupuesto aprobado (USD)
                <span class="text-red-500">*</span>

            </label>

            <input
                type="number"
                step="0.01"
                min="0"
                id="presupuesto_aprobado"
                name="presupuesto_aprobado"
                value="{{ old('presupuesto_aprobado', $proyecto->presupuesto_aprobado ?? '') }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('presupuesto_aprobado')

                <p class="mt-1 text-sm text-red-600">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <!-- Nombre -->
        <div class="md:col-span-2">

            <label
                for="nombre"
                class="block text-sm font-medium text-gray-700 mb-1">

                Nombre del proyecto
                <span class="text-red-500">*</span>

            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                maxlength="255"
                value="{{ old('nombre', $proyecto->nombre ?? '') }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('nombre')

                <p class="mt-1 text-sm text-red-600">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <!-- Descripción -->
        <div class="md:col-span-2">

            <label
                for="descripcion"
                class="block text-sm font-medium text-gray-700 mb-1">

                Descripción

            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                rows="4"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion', $proyecto->descripcion ?? '') }}</textarea>

            @error('descripcion')

                <p class="mt-1 text-sm text-red-600">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <!-- Fecha inicio -->
        <div>

            <label
                for="fecha_inicio"
                class="block text-sm font-medium text-gray-700 mb-1">

                Fecha de inicio
                <span class="text-red-500">*</span>

            </label>

            <input
                type="date"
                id="fecha_inicio"
                name="fecha_inicio"
                value="{{ old('fecha_inicio', $proyecto->fecha_inicio ?? '') }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('fecha_inicio')

                <p class="mt-1 text-sm text-red-600">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <!-- Fecha fin -->
        <div>

            <label
                for="fecha_fin"
                class="block text-sm font-medium text-gray-700 mb-1">

                Fecha de finalización
                <span class="text-red-500">*</span>

            </label>

            <input
                type="date"
                id="fecha_fin"
                name="fecha_fin"
                value="{{ old('fecha_fin', $proyecto->fecha_fin ?? '') }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('fecha_fin')

                <p class="mt-1 text-sm text-red-600">

                    {{ $message }}

                </p>

            @enderror

        </div>

    </div>

</div>