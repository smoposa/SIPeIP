@php
    $editando = isset($subsector);

    $sectorSeleccionado = old(
        'sector_id',
        $editando
            ? $subsector->sector_id
            : request('sector_id')
    );

    $macrosectorSeleccionado = old(
        'macrosector_id',
        $editando
            ? optional($subsector->sector)->macrosector_id
            : request('macrosector_id')
    );

    $estadoSeleccionado = (string) old(
        'estado',
        $editando
            ? ($subsector->estado === 'Activo' ? '1' : '0')
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
            data-url-template="{{ route(
                'clasificacion-inversion.macrosectores.sectores',
                ['macrosector' => '__ID__']
            ) }}"
            class="block w-full rounded-md border-gray-300 bg-white
                   text-sm text-gray-700 shadow-sm
                   focus:border-blue-500 focus:ring-blue-500"
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

        <p class="mt-1 text-xs text-gray-500">
            Seleccione primero el macrosector para cargar sus sectores.
        </p>

    </div>

    {{-- Sector --}}
    <div>

        <label
            for="sector_id"
            class="mb-1.5 block text-sm font-medium text-gray-700"
        >
            Sector
            <span class="text-red-500">*</span>
        </label>

        <select
            id="sector_id"
            name="sector_id"
            required
            data-selected="{{ $sectorSeleccionado }}"
            disabled
            class="block w-full rounded-md border-gray-300 bg-white
                   text-sm text-gray-700 shadow-sm
                   focus:border-blue-500 focus:ring-blue-500
                   disabled:cursor-not-allowed disabled:bg-gray-100
                   @error('sector_id')
                       border-red-400 focus:border-red-500
                       focus:ring-red-500
                   @enderror"
        >
            <option value="">
                Seleccione primero un macrosector
            </option>
        </select>

        @error('sector_id')

            <p class="mt-1 text-xs text-red-600">
                {{ $message }}
            </p>

        @enderror

        <p
            id="sectorHelp"
            class="mt-1 text-xs text-gray-500"
        >
            El subsector quedará relacionado con el sector seleccionado.
        </p>

    </div>

    {{-- Código --}}
    <div>

        <label
            for="codigo"
            class="mb-1.5 block text-sm font-medium text-gray-700"
        >
            Código oficial
            <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="codigo"
            name="codigo"
            value="{{ old(
                'codigo',
                $editando ? $subsector->codigo : ''
            ) }}"
            required
            maxlength="20"
            autocomplete="off"
            placeholder="Ejemplo: C1501"
            class="block w-full rounded-md border-gray-300
                   font-mono text-sm uppercase text-gray-700 shadow-sm
                   placeholder:font-sans placeholder:normal-case
                   placeholder:text-gray-400
                   focus:border-blue-500 focus:ring-blue-500
                   @error('codigo')
                       border-red-400 focus:border-red-500
                       focus:ring-red-500
                   @enderror"
        >

        @error('codigo')

            <p class="mt-1 text-xs text-red-600">
                {{ $message }}
            </p>

        @enderror

        <p class="mt-1 text-xs text-gray-500">
            Ingrese el código oficial asignado al subsector.
        </p>

    </div>

    {{-- Nombre --}}
    <div>

        <label
            for="nombre"
            class="mb-1.5 block text-sm font-medium text-gray-700"
        >
            Nombre del subsector
            <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="{{ old(
                'nombre',
                $editando ? $subsector->nombre : ''
            ) }}"
            required
            maxlength="255"
            autocomplete="off"
            placeholder="Ingrese el nombre del subsector"
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

    {{-- Nivel de gobierno --}}
    <div>

        <label
            for="nivel_gobierno"
            class="mb-1.5 block text-sm font-medium text-gray-700"
        >
            Nivel de gobierno
            <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="nivel_gobierno"
            name="nivel_gobierno"
            value="{{ old(
                'nivel_gobierno',
                $editando
                    ? $subsector->nivel_gobierno
                    : 'Nacional'
            ) }}"
            required
            readonly
            class="block w-full cursor-not-allowed rounded-md
                   border-gray-300 bg-gray-100 text-sm
                   text-gray-600 shadow-sm"
        >

        @error('nivel_gobierno')

            <p class="mt-1 text-xs text-red-600">
                {{ $message }}
            </p>

        @enderror

        <p class="mt-1 text-xs text-gray-500">
            De acuerdo con la clasificación institucional, el nivel es nacional.
        </p>

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

    </div>

</div>

@once
    @push('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const macrosectorSelect =
                    document.getElementById('macrosector_id');

                const sectorSelect =
                    document.getElementById('sector_id');

                const sectorHelp =
                    document.getElementById('sectorHelp');

                if (!macrosectorSelect || !sectorSelect) {
                    return;
                }

                const sectorSeleccionado =
                    String(sectorSelect.dataset.selected || '');

                const urlTemplate =
                    macrosectorSelect.dataset.urlTemplate;

                function establecerMensaje(mensaje) {
                    sectorSelect.innerHTML = '';

                    const option = document.createElement('option');

                    option.value = '';
                    option.textContent = mensaje;

                    sectorSelect.appendChild(option);
                }

                async function cargarSectores(
                    macrosectorId,
                    sectorId = ''
                ) {
                    if (!macrosectorId) {
                        establecerMensaje(
                            'Seleccione primero un macrosector'
                        );

                        sectorSelect.disabled = true;
                        return;
                    }

                    establecerMensaje('Cargando sectores...');
                    sectorSelect.disabled = true;

                    if (sectorHelp) {
                        sectorHelp.textContent =
                            'Consultando los sectores disponibles...';
                    }

                    try {
                        const url = urlTemplate.replace(
                            '__ID__',
                            macrosectorId
                        );

                        const response = await fetch(url, {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) {
                            throw new Error(
                                'No se pudieron obtener los sectores.'
                            );
                        }

                        const sectores = await response.json();

                        establecerMensaje('Seleccione un sector');

                        sectores.forEach(function (sector) {
                            const option =
                                document.createElement('option');

                            option.value = sector.id;
                            option.textContent = sector.nombre;
                            option.selected =
                                String(sector.id) === String(sectorId);

                            sectorSelect.appendChild(option);
                        });

                        sectorSelect.disabled = sectores.length === 0;

                        if (sectorHelp) {
                            sectorHelp.textContent = sectores.length > 0
                                ? 'Seleccione el sector al que pertenece el subsector.'
                                : 'El macrosector seleccionado no tiene sectores activos.';
                        }
                    } catch (error) {
                        establecerMensaje(
                            'No fue posible cargar los sectores'
                        );

                        sectorSelect.disabled = true;

                        if (sectorHelp) {
                            sectorHelp.textContent =
                                'Ocurrió un error al consultar los sectores.';
                        }
                    }
                }

                macrosectorSelect.addEventListener(
                    'change',
                    function () {
                        cargarSectores(this.value);
                    }
                );

                if (macrosectorSelect.value) {
                    cargarSectores(
                        macrosectorSelect.value,
                        sectorSeleccionado
                    );
                }
            });
        </script>

    @endpush
@endonce