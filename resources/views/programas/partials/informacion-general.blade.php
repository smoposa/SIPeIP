@php
    $editando = isset($programa);

    $objetivosSeleccionados = old(
        'objetivos',
        $editando
            ? $programa->objetivos
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->all()
            : []
    );
@endphp

<div class="mb-5 rounded-lg border border-gray-200 bg-white p-5">

    <div class="mb-5">

        <h3 class="text-base font-semibold text-gray-800">
            Información general
        </h3>

        <p class="mt-0.5 text-xs text-gray-500">
            Registre la información institucional y el período
            de vigencia del programa.
        </p>

    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

        {{-- Código --}}
        <div>

            <label
                for="codigo_visual"
                class="mb-1.5 block text-sm font-medium text-gray-700"
            >
                Código institucional
            </label>

            <input
                type="text"
                id="codigo_visual"
                value="{{ $editando
                    ? $programa->codigo
                    : $codigo }}"
                readonly
                class="block w-full cursor-not-allowed rounded-md
                       border-gray-300 bg-gray-100 font-mono text-sm
                       font-semibold text-gray-600 shadow-sm"
            >

            <p class="mt-1 text-xs text-gray-500">
                El código se genera automáticamente dentro de la entidad.
            </p>

        </div>

        {{-- Responsable --}}
        <div>

            <label
                for="responsable_id"
                class="mb-1.5 block text-sm font-medium text-gray-700"
            >
                Responsable
                <span class="text-red-500">*</span>
            </label>

            <select
                id="responsable_id"
                name="responsable_id"
                required
                class="block w-full rounded-md border-gray-300 bg-white
                       text-sm text-gray-700 shadow-sm
                       focus:border-blue-500 focus:ring-blue-500
                       @error('responsable_id')
                           border-red-400 focus:border-red-500
                           focus:ring-red-500
                       @enderror"
            >
                <option value="">
                    Seleccione un responsable
                </option>

                @foreach($responsables as $responsable)

                    <option
                        value="{{ $responsable->id }}"
                        @selected(
                            (string) old(
                                'responsable_id',
                                $editando
                                    ? $programa->responsable_id
                                    : ''
                            ) === (string) $responsable->id
                        )
                    >
                        {{ $responsable->nombres }}
                        {{ $responsable->apellidos }}

                        @if($responsable->cargo)
                            — {{ $responsable->cargo }}
                        @endif
                    </option>

                @endforeach

            </select>

            @error('responsable_id')

                <p class="mt-1 text-xs text-red-600">
                    {{ $message }}
                </p>

            @enderror

            @if($responsables->isEmpty())

                <p class="mt-1 text-xs text-amber-600">
                    La entidad no tiene usuarios activos disponibles
                    para asignar como responsables.
                </p>

            @endif

        </div>

        {{-- Nombre --}}
        <div class="md:col-span-2">

            <label
                for="nombre"
                class="mb-1.5 block text-sm font-medium text-gray-700"
            >
                Nombre del programa
                <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old(
                    'nombre',
                    $editando ? $programa->nombre : ''
                ) }}"
                required
                maxlength="255"
                autocomplete="off"
                placeholder="Ingrese el nombre del programa"
                class="block w-full rounded-md border-gray-300
                       text-sm text-gray-700 shadow-sm
                       placeholder:text-gray-400
                       focus:border-blue-500 focus:ring-blue-500
                       @error('nombre')
                           border-red-400 focus:border-red-500
                           focus:ring-red-500
                       @enderror"
            >

            @error('nombre')

                <p class="mt-1 text-xs text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        {{-- Descripción --}}
        <div class="md:col-span-2">

            <label
                for="descripcion"
                class="mb-1.5 block text-sm font-medium text-gray-700"
            >
                Descripción
            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                rows="4"
                maxlength="5000"
                placeholder="Describa el propósito y alcance del programa"
                class="block w-full resize-y rounded-md border-gray-300
                       text-sm text-gray-700 shadow-sm
                       placeholder:text-gray-400
                       focus:border-blue-500 focus:ring-blue-500
                       @error('descripcion')
                           border-red-400 focus:border-red-500
                           focus:ring-red-500
                       @enderror"
            >{{ old(
                'descripcion',
                $editando ? $programa->descripcion : ''
            ) }}</textarea>

            @error('descripcion')

                <p class="mt-1 text-xs text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        {{-- Período inicial --}}
        <div>

            <label
                for="periodo_inicio"
                class="mb-1.5 block text-sm font-medium text-gray-700"
            >
                Período inicial
                <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                id="periodo_inicio"
                name="periodo_inicio"
                value="{{ old(
                    'periodo_inicio',
                    $editando ? $programa->periodo_inicio : ''
                ) }}"
                required
                min="2000"
                max="2100"
                step="1"
                placeholder="Ejemplo: 2026"
                class="block w-full rounded-md border-gray-300
                       text-sm text-gray-700 shadow-sm
                       placeholder:text-gray-400
                       focus:border-blue-500 focus:ring-blue-500
                       @error('periodo_inicio')
                           border-red-400 focus:border-red-500
                           focus:ring-red-500
                       @enderror"
            >

            @error('periodo_inicio')

                <p class="mt-1 text-xs text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        {{-- Período final --}}
        <div>

            <label
                for="periodo_fin"
                class="mb-1.5 block text-sm font-medium text-gray-700"
            >
                Período final
                <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                id="periodo_fin"
                name="periodo_fin"
                value="{{ old(
                    'periodo_fin',
                    $editando ? $programa->periodo_fin : ''
                ) }}"
                required
                min="2000"
                max="2100"
                step="1"
                placeholder="Ejemplo: 2029"
                class="block w-full rounded-md border-gray-300
                       text-sm text-gray-700 shadow-sm
                       placeholder:text-gray-400
                       focus:border-blue-500 focus:ring-blue-500
                       @error('periodo_fin')
                           border-red-400 focus:border-red-500
                           focus:ring-red-500
                       @enderror"
            >

            @error('periodo_fin')

                <p class="mt-1 text-xs text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

    </div>

    {{-- Objetivos estratégicos --}}
    <div class="mt-6 border-t border-gray-200 pt-5">

        <label class="block text-sm font-medium text-gray-700">
            Objetivos Estratégicos Institucionales (OEI)
            <span class="text-red-500">*</span>
        </label>

        <p class="mt-0.5 text-xs text-gray-500">
            Seleccione uno o varios objetivos pertenecientes
            a la entidad.
        </p>

        <div class="mt-3 max-h-72 overflow-y-auto rounded-md
                    border border-gray-300 bg-white p-3
                    @error('objetivos') border-red-400 @enderror">

            @forelse($objetivos as $objetivo)

                <label class="flex cursor-pointer items-start gap-3
                              border-b border-gray-100 px-2 py-3
                              last:border-b-0 hover:bg-gray-50">

                    <input
                        type="checkbox"
                        name="objetivos[]"
                        value="{{ $objetivo->id }}"
                        @checked(
                            in_array(
                                (string) $objetivo->id,
                                array_map(
                                    'strval',
                                    $objetivosSeleccionados
                                ),
                                true
                            )
                        )
                        class="mt-1 rounded border-gray-300
                               text-blue-600 focus:ring-blue-500"
                    >

                    <span class="min-w-0">

                        <span class="block text-sm font-medium text-gray-800">
                            {{ $objetivo->codigo }}
                            — {{ $objetivo->nombre }}
                        </span>

                        @if($objetivo->plan)

                            <span class="mt-0.5 block text-xs text-gray-500">
                                Plan: {{ $objetivo->plan->nombre }}
                            </span>

                        @endif

                    </span>

                </label>

            @empty

                <div class="px-3 py-6 text-center">

                    <i class="bi bi-inbox text-2xl text-gray-300"></i>

                    <p class="mt-2 text-sm text-gray-500">
                        La entidad no tiene objetivos estratégicos
                        activos disponibles.
                    </p>

                </div>

            @endforelse

        </div>

        @error('objetivos')

            <p class="mt-2 text-xs text-red-600">
                {{ $message }}
            </p>

        @enderror

        @error('objetivos.*')

            <p class="mt-2 text-xs text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>

</div>