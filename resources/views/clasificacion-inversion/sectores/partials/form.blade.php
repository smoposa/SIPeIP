@php
    $editando = isset($sector);

    $macrosectorPredeterminado = $editando
        ? $sector->macrosector_id
        : request('macrosector_id');

    $macrosectorSeleccionado = old(
        'macrosector_id',
        $macrosectorPredeterminado
    );

    $estadoSeleccionado = (string) old(
        'estado',
        $editando
            ? ($sector->estado === 'Activo' ? '1' : '0')
            : '1'
    );
@endphp

<div class="space-y-5">

    {{-- Macrosector --}}
    <div>

        <label
            for="macrosector_id"
            class="mb-1.5 block text-sm font-medium text-gray-700"
        >
            Macrosector
            <span class="text-red-500">*</span>
        </label>

        <select
            id="macrosector_id"
            name="macrosector_id"
            required
            class="block w-full rounded-md border-gray-300 bg-white
                   text-sm text-gray-700 shadow-sm
                   focus:border-blue-500 focus:ring-blue-500
                   @error('macrosector_id')
                       border-red-400 focus:border-red-500
                       focus:ring-red-500
                   @enderror"
        >
            <option value="">
                Seleccione un macrosector
            </option>

            @foreach($macrosectores as $macrosector)

                <option
                    value="{{ $macrosector->id }}"
                    @selected(
                        (string) $macrosectorSeleccionado
                        === (string) $macrosector->id
                    )
                >
                    {{ $macrosector->nombre }}
                </option>

            @endforeach

        </select>

        @error('macrosector_id')

            <p class="mt-1 text-xs text-red-600">
                {{ $message }}
            </p>

        @enderror

        <p class="mt-1 text-xs text-gray-500">
            Seleccione el macrosector al que pertenece el sector.
        </p>

    </div>

    {{-- Nombre --}}
    <div>

        <label
            for="nombre"
            class="mb-1.5 block text-sm font-medium text-gray-700"
        >
            Nombre del sector
            <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="{{ old(
                'nombre',
                $editando ? $sector->nombre : ''
            ) }}"
            required
            maxlength="255"
            autocomplete="off"
            placeholder="Ingrese el nombre del sector"
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

    {{-- Estado --}}
    <div>

        <label
            for="estado"
            class="mb-1.5 block text-sm font-medium text-gray-700"
        >
            Estado
            <span class="text-red-500">*</span>
        </label>

        <select
            id="estado"
            name="estado"
            required
            class="block w-full rounded-md border-gray-300 bg-white
                   text-sm text-gray-700 shadow-sm
                   focus:border-blue-500 focus:ring-blue-500
                   @error('estado')
                       border-red-400 focus:border-red-500
                       focus:ring-red-500
                   @enderror"
        >
            <option
                value="1"
                @selected($estadoSeleccionado === '1')
            >
                Activo
            </option>

            <option
                value="0"
                @selected($estadoSeleccionado === '0')
            >
                Inactivo
            </option>
        </select>

        @error('estado')

            <p class="mt-1 text-xs text-red-600">
                {{ $message }}
            </p>

        @enderror

        <p class="mt-1 text-xs text-gray-500">
            Los sectores inactivos no estarán disponibles para nuevos registros.
        </p>

    </div>

</div>