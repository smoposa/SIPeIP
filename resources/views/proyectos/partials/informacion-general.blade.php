<div class="mb-6 rounded-lg border border-gray-200 bg-white p-6">

    <h3 class="mb-5 text-lg font-semibold text-gray-800">
        Información general
    </h3>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        {{-- Código --}}
        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">
                Código
            </label>

            <input
                type="text"
                value="{{ $proyecto->codigo ?? $codigo }}"
                class="w-full rounded-md border-gray-300 bg-gray-100 text-gray-600 shadow-sm"
                readonly>
        </div>

        {{-- Programa --}}
        <div>
            <label for="programa_id"
                class="mb-1 block text-sm font-medium text-gray-700">

                Programa de inversión
                <span class="text-red-500">*</span>
            </label>

            <select
                id="programa_id"
                name="programa_id"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <option value="">
                    Seleccione un programa
                </option>

                @foreach ($programas as $programa)
                    <option
                        value="{{ $programa->id }}"
                        @selected(
                            (int) old(
                                'programa_id',
                                $proyecto->programa_id ?? ''
                            ) === $programa->id
                        )>

                        {{ $programa->codigo }}
                        -
                        {{ $programa->nombre }}
                        ({{ $programa->periodo_inicio }}-{{ $programa->periodo_fin }})
                    </option>
                @endforeach

            </select>

            @if ($programas->isEmpty())
                <p class="mt-1 text-sm text-amber-700">
                    No existen programas activos disponibles para su entidad.
                </p>
            @else
                <p class="mt-1 text-xs text-gray-500">
                    Las fechas del proyecto deben estar dentro del período del programa.
                </p>
            @endif

            @error('programa_id')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Responsable --}}
        <div>
            <label for="responsable_id"
                class="mb-1 block text-sm font-medium text-gray-700">

                Responsable institucional
                <span class="text-red-500">*</span>
            </label>

            <select
                id="responsable_id"
                name="responsable_id"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <option value="">
                    Seleccione un responsable
                </option>

                @foreach ($responsables as $responsable)
                    <option
                        value="{{ $responsable->id }}"
                        @selected(
                            (int) old(
                                'responsable_id',
                                $proyecto->responsable_id ?? ''
                            ) === $responsable->id
                        )>

                        {{ $responsable->nombres }}
                        {{ $responsable->apellidos }}

                        @if ($responsable->cargo)
                            - {{ $responsable->cargo }}
                        @endif
                    </option>
                @endforeach

            </select>

            @if ($responsables->isEmpty())
                <p class="mt-1 text-sm text-amber-700">
                    No existen usuarios activos disponibles en su entidad.
                </p>
            @endif

            @error('responsable_id')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Presupuesto --}}
        <div>
            <label for="presupuesto_aprobado"
                class="mb-1 block text-sm font-medium text-gray-700">

                Presupuesto aprobado (USD)
                <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                id="presupuesto_aprobado"
                name="presupuesto_aprobado"
                value="{{ old(
                    'presupuesto_aprobado',
                    $proyecto->presupuesto_aprobado ?? ''
                ) }}"
                min="0"
                max="9999999999999.99"
                step="0.01"
                placeholder="0.00"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('presupuesto_aprobado')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Nombre --}}
        <div class="md:col-span-2">
            <label for="nombre"
                class="mb-1 block text-sm font-medium text-gray-700">

                Nombre del proyecto
                <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre', $proyecto->nombre ?? '') }}"
                maxlength="255"
                placeholder="Ingrese el nombre del proyecto"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('nombre')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Descripción --}}
        <div class="md:col-span-2">
            <label for="descripcion"
                class="mb-1 block text-sm font-medium text-gray-700">
                Descripción
            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                rows="4"
                maxlength="5000"
                placeholder="Describa el propósito y alcance general del proyecto"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion', $proyecto->descripcion ?? '') }}</textarea>

            @error('descripcion')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Fecha de inicio --}}
        <div>
            <label for="fecha_inicio"
                class="mb-1 block text-sm font-medium text-gray-700">

                Fecha de inicio
                <span class="text-red-500">*</span>
            </label>

            <input
                type="date"
                id="fecha_inicio"
                name="fecha_inicio"
                value="{{ old(
                    'fecha_inicio',
                    isset($proyecto)
                        ? $proyecto->fecha_inicio?->format('Y-m-d')
                        : ''
                ) }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('fecha_inicio')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Fecha de finalización --}}
        <div>
            <label for="fecha_fin"
                class="mb-1 block text-sm font-medium text-gray-700">

                Fecha de finalización
                <span class="text-red-500">*</span>
            </label>

            <input
                type="date"
                id="fecha_fin"
                name="fecha_fin"
                value="{{ old(
                    'fecha_fin',
                    isset($proyecto)
                        ? $proyecto->fecha_fin?->format('Y-m-d')
                        : ''
                ) }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('fecha_fin')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

    </div>

</div>