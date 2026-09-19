@php
    $subsectorActual = $proyecto->subsector ?? null;
    $sectorActual = $subsectorActual?->sector;
    $macrosectorActual = $sectorActual?->macrosector;

    $macrosectorSeleccionado = old(
        'macrosector_id',
        $macrosectorActual?->id
    );

    $sectorSeleccionado = old(
        'sector_id',
        $sectorActual?->id
    );

    $subsectorSeleccionado = old(
        'subsector_id',
        $subsectorActual?->id
    );
@endphp

<div class="mb-6 rounded-lg border border-gray-200 bg-white p-6">

    <h3 class="mb-2 text-lg font-semibold text-gray-800">
        Clasificación de la intervención
    </h3>

    <p class="mb-5 text-sm text-gray-500">
        Seleccione la clasificación oficial correspondiente al ámbito
        de intervención del proyecto.
    </p>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

        {{-- Macrosector --}}
        <div>
            <label for="macrosector_id"
                class="mb-1 block text-sm font-medium text-gray-700">

                Macrosector
                <span class="text-red-500">*</span>
            </label>

            <select
                id="macrosector_id"
                name="macrosector_id"
                required
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <option value="">
                    Seleccione un macrosector
                </option>

                @foreach ($macrosectores as $macrosector)
                    <option
                        value="{{ $macrosector->id }}"
                        @selected(
                            (int) $macrosectorSeleccionado
                            === $macrosector->id
                        )>

                        {{ $macrosector->nombre }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- Sector --}}
        <div>
            <label for="sector_id"
                class="mb-1 block text-sm font-medium text-gray-700">

                Sector
                <span class="text-red-500">*</span>
            </label>

            <select
                id="sector_id"
                name="sector_id"
                required
                disabled
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100 disabled:text-gray-500">

                <option value="">
                    Seleccione primero un macrosector
                </option>

            </select>
        </div>

        {{-- Subsector --}}
        <div>
            <label for="subsector_id"
                class="mb-1 block text-sm font-medium text-gray-700">

                Subsector
                <span class="text-red-500">*</span>
            </label>

            <select
                id="subsector_id"
                name="subsector_id"
                required
                disabled
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100 disabled:text-gray-500">

                <option value="">
                    Seleccione primero un sector
                </option>

            </select>

            @error('subsector_id')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const macrosectorSelect = document.getElementById(
            'macrosector_id'
        );

        const sectorSelect = document.getElementById(
            'sector_id'
        );

        const subsectorSelect = document.getElementById(
            'subsector_id'
        );

        const sectorSeleccionado = @json(
            (string) ($sectorSeleccionado ?? '')
        );

        const subsectorSeleccionado = @json(
            (string) ($subsectorSeleccionado ?? '')
        );

        const rutaSectores = @json(
            route(
                'clasificacion-inversion.macrosectores.sectores',
                ['macrosector' => '__ID__']
            )
        );

        const rutaSubsectores = @json(
            route(
                'clasificacion-inversion.sectores.subsectores',
                ['sector' => '__ID__']
            )
        );

        const limpiarSelect = (
            select,
            mensaje
        ) => {
            select.innerHTML = '';

            select.appendChild(
                new Option(
                    mensaje,
                    ''
                )
            );

            select.disabled = true;
        };

        const cargarSectores = async (
            macrosectorId,
            valorSeleccionado = ''
        ) => {
            limpiarSelect(
                sectorSelect,
                'Cargando sectores...'
            );

            limpiarSelect(
                subsectorSelect,
                'Seleccione primero un sector'
            );

            if (!macrosectorId) {
                limpiarSelect(
                    sectorSelect,
                    'Seleccione primero un macrosector'
                );

                return;
            }

            try {
                const respuesta = await fetch(
                    rutaSectores.replace(
                        '__ID__',
                        macrosectorId
                    ),
                    {
                        headers: {
                            'Accept': 'application/json',
                        },
                    }
                );

                if (!respuesta.ok) {
                    throw new Error(
                        'No fue posible cargar los sectores.'
                    );
                }

                const sectores = await respuesta.json();

                sectorSelect.innerHTML = '';
                sectorSelect.appendChild(
                    new Option(
                        'Seleccione un sector',
                        ''
                    )
                );

                sectores.forEach((sector) => {
                    const opcion = new Option(
                        sector.nombre,
                        sector.id
                    );

                    opcion.selected =
                        String(sector.id)
                        === String(valorSeleccionado);

                    sectorSelect.appendChild(opcion);
                });

                sectorSelect.disabled = false;

                if (valorSeleccionado) {
                    await cargarSubsectores(
                        valorSeleccionado,
                        subsectorSeleccionado
                    );
                }
            } catch (error) {
                limpiarSelect(
                    sectorSelect,
                    'No fue posible cargar los sectores'
                );

                console.error(error);
            }
        };

        const cargarSubsectores = async (
            sectorId,
            valorSeleccionado = ''
        ) => {
            limpiarSelect(
                subsectorSelect,
                'Cargando subsectores...'
            );

            if (!sectorId) {
                limpiarSelect(
                    subsectorSelect,
                    'Seleccione primero un sector'
                );

                return;
            }

            try {
                const respuesta = await fetch(
                    rutaSubsectores.replace(
                        '__ID__',
                        sectorId
                    ),
                    {
                        headers: {
                            'Accept': 'application/json',
                        },
                    }
                );

                if (!respuesta.ok) {
                    throw new Error(
                        'No fue posible cargar los subsectores.'
                    );
                }

                const subsectores = await respuesta.json();

                subsectorSelect.innerHTML = '';
                subsectorSelect.appendChild(
                    new Option(
                        'Seleccione un subsector',
                        ''
                    )
                );

                subsectores.forEach((subsector) => {
                    const opcion = new Option(
                        `${subsector.codigo} - ${subsector.nombre}`,
                        subsector.id
                    );

                    opcion.selected =
                        String(subsector.id)
                        === String(valorSeleccionado);

                    subsectorSelect.appendChild(opcion);
                });

                subsectorSelect.disabled = false;
            } catch (error) {
                limpiarSelect(
                    subsectorSelect,
                    'No fue posible cargar los subsectores'
                );

                console.error(error);
            }
        };

        macrosectorSelect.addEventListener(
            'change',
            () => {
                cargarSectores(
                    macrosectorSelect.value
                );
            }
        );

        sectorSelect.addEventListener(
            'change',
            () => {
                cargarSubsectores(
                    sectorSelect.value
                );
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