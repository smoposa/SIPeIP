@php
    $registro = $avance ?? null;
    $claseCampo = 'w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                   focus:border-blue-500 focus:ring-blue-500';
@endphp

<p class="mb-5 text-xs text-gray-500">
    Los campos con <span class="text-red-600">*</span> son obligatorios.
</p>


<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <!-- Proyecto -->
    <div class="md:col-span-2">

        <label for="proyecto_id"
               class="mb-1 block text-sm font-medium text-gray-700">
            Proyecto <span class="text-red-600">*</span>
        </label>

        <select id="proyecto_id"
                name="proyecto_id"
                required
                class="{{ $claseCampo }}">

            <option value="">Seleccione un proyecto</option>

            @foreach($proyectos as $proyecto)

                <option value="{{ $proyecto->id }}"
                    @selected(
                        (string) old('proyecto_id', $registro?->proyecto_id ?? request('proyecto_id'))
                        === (string) $proyecto->id
                    )>

                    {{ $proyecto->codigo }} - {{ $proyecto->nombre }}

                </option>

            @endforeach

        </select>

        <x-input-error :messages="$errors->get('proyecto_id')" class="mt-1" />

    </div>


    <!-- Indicador -->
    <div class="md:col-span-2">

        <label for="indicador_id"
               class="mb-1 block text-sm font-medium text-gray-700">
            Indicador <span class="text-red-600">*</span>
        </label>

        <select id="indicador_id"
                name="indicador_id"
                required
                data-selected="{{ old('indicador_id', $registro?->indicador_id) }}"
                aria-describedby="estadoCargaIndicadores"
                class="{{ $claseCampo }}">

            <option value="">Seleccione un indicador</option>

            @foreach($indicadores as $indicador)

                <option value="{{ $indicador->id }}"
                    @selected(
                        (string) old('indicador_id', $registro?->indicador_id)
                        === (string) $indicador->id
                    )>

                    {{ $indicador->codigo }} - {{ $indicador->nombre }}
                    ({{ $indicador->unidad_medida }})

                </option>

            @endforeach

        </select>

        <p id="estadoCargaIndicadores"
           role="status"
           aria-live="polite"
           class="mt-1 text-xs text-gray-500"></p>

        <button type="button"
                id="reintentarIndicadores"
                class="hidden mt-1 text-xs text-blue-600 hover:underline">
            Reintentar carga
        </button>

        <x-input-error :messages="$errors->get('indicador_id')" class="mt-1" />

    </div>


    <!-- Año -->
    <div>

        <label for="anio" class="mb-1 block text-sm font-medium text-gray-700">
            Año <span class="text-red-600">*</span>
        </label>

        <input type="number"
               id="anio"
               name="anio"
               min="2000"
               max="2100"
               required
               value="{{ old('anio', $registro?->anio ?? now()->year) }}"
               class="{{ $claseCampo }}">

        <x-input-error :messages="$errors->get('anio')" class="mt-1" />

    </div>


    <!-- Período -->
    <div>

        <label for="periodo" class="mb-1 block text-sm font-medium text-gray-700">
            Período <span class="text-red-600">*</span>
        </label>

        <select id="periodo" name="periodo" required class="{{ $claseCampo }}">

            @foreach($periodos as $periodo)

                <option value="{{ $periodo->value }}"
                    @selected(old('periodo', $registro?->periodo) === $periodo->value)>
                    {{ $periodo->value }}
                </option>

            @endforeach

        </select>

        <x-input-error :messages="$errors->get('periodo')" class="mt-1" />

    </div>


    <!-- Fecha de corte -->
    <div>

        <label for="fecha_corte" class="mb-1 block text-sm font-medium text-gray-700">
            Fecha de corte <span class="text-red-600">*</span>
        </label>

        <input type="date"
               id="fecha_corte"
               name="fecha_corte"
               required
               value="{{ old('fecha_corte', $registro?->fecha_corte?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
               class="{{ $claseCampo }}">

        <x-input-error :messages="$errors->get('fecha_corte')" class="mt-1" />

    </div>


    <!-- Estado -->
    <div>

        <label for="estado" class="mb-1 block text-sm font-medium text-gray-700">
            Estado <span class="text-red-600">*</span>
        </label>

        <select id="estado"
                name="estado"
                required
                aria-describedby="ayudaEstadoAvance"
                class="{{ $claseCampo }}">

            @foreach($estados as $estado)

                <option value="{{ $estado->value }}"
                    @selected(old('estado', $registro?->estado ?? 'Borrador') === $estado->value)>
                    {{ $estado->value }}
                </option>

            @endforeach

        </select>

        <p id="ayudaEstadoAvance" class="mt-1 text-xs text-gray-500">
            Al cerrar el registro ya no podrá editarse.
        </p>

        <x-input-error :messages="$errors->get('estado')" class="mt-1" />

    </div>


    <!-- Valor programado -->
    <div>

        <label for="valor_programado" class="mb-1 block text-sm font-medium text-gray-700">
            Valor programado <span class="text-red-600">*</span>
        </label>

        <input type="number"
               id="valor_programado"
               name="valor_programado"
               step="0.0001"
               min="0.0001"
               required
               value="{{ old('valor_programado', $registro?->valor_programado) }}"
               class="{{ $claseCampo }}">

        <x-input-error :messages="$errors->get('valor_programado')" class="mt-1" />

    </div>


    <!-- Valor ejecutado -->
    <div>

        <label for="valor_ejecutado" class="mb-1 block text-sm font-medium text-gray-700">
            Valor ejecutado <span class="text-red-600">*</span>
        </label>

        <input type="number"
               id="valor_ejecutado"
               name="valor_ejecutado"
               step="0.0001"
               min="0"
               required
               value="{{ old('valor_ejecutado', $registro?->valor_ejecutado) }}"
               class="{{ $claseCampo }}">

        <x-input-error :messages="$errors->get('valor_ejecutado')" class="mt-1" />

    </div>


    <!-- Resultado -->
    <div class="md:col-span-2">

        <label for="resultado" class="mb-1 block text-sm font-medium text-gray-700">
            Resultado alcanzado
        </label>

        <textarea id="resultado"
                  name="resultado"
                  rows="3"
                  class="{{ $claseCampo }}">{{ old('resultado', $registro?->resultado) }}</textarea>

        <x-input-error :messages="$errors->get('resultado')" class="mt-1" />

    </div>


    <!-- Observaciones -->
    <div class="md:col-span-2">

        <label for="observaciones" class="mb-1 block text-sm font-medium text-gray-700">
            Observaciones
        </label>

        <textarea id="observaciones"
                  name="observaciones"
                  rows="3"
                  class="{{ $claseCampo }}">{{ old('observaciones', $registro?->observaciones) }}</textarea>

        <x-input-error :messages="$errors->get('observaciones')" class="mt-1" />

    </div>

</div>


<script>
    (() => {
        function inicializarFormularioAvance() {
            const proyecto = document.getElementById('proyecto_id');
            const indicador = document.getElementById('indicador_id');
            const mensaje = document.getElementById('estadoCargaIndicadores');
            const reintentar = document.getElementById('reintentarIndicadores');

            if (!proyecto || !indicador || !mensaje || !reintentar) return;

            const plantilla = @json(route('avances.indicadores', ['proyecto' => '__ID__']));

            let peticionActual = null;

            function mostrarOpcion(texto) {
                indicador.replaceChildren(new Option(texto, ''));
            }

            async function cargarIndicadores() {
                peticionActual?.abort();

                const peticion = new AbortController();
                peticionActual = peticion;

                const seleccionado = indicador.dataset.selected ?? '';

                reintentar.classList.add('hidden');
                mensaje.textContent = '';
                indicador.disabled = true;
                indicador.setAttribute('aria-busy', 'false');

                if (!proyecto.value) {
                    mostrarOpcion('Seleccione primero un proyecto');
                    return;
                }

                mostrarOpcion('Cargando indicadores...');
                mensaje.textContent = 'Cargando indicadores del proyecto.';
                indicador.setAttribute('aria-busy', 'true');

                try {
                    const respuesta = await fetch(
                        plantilla.replace('__ID__', encodeURIComponent(proyecto.value)),
                        {
                            headers: { 'Accept': 'application/json' },
                            signal: peticion.signal
                        }
                    );

                    if (!respuesta.ok) {
                        throw new Error('No se pudieron cargar los indicadores.');
                    }

                    const datos = await respuesta.json();

                    if (!Array.isArray(datos)) {
                        throw new Error('Respuesta de indicadores inválida.');
                    }

                    if (peticionActual !== peticion) return;

                    mostrarOpcion(
                        datos.length
                            ? 'Seleccione un indicador'
                            : 'No existen indicadores disponibles'
                    );

                    datos.forEach(item => {
                        const opcion = new Option(
                            `${item.codigo} - ${item.nombre} (${item.unidad_medida ?? ''})`,
                            String(item.id)
                        );

                        opcion.selected = String(item.id) === String(seleccionado);

                        indicador.add(opcion);
                    });

                    mensaje.textContent = datos.length
                        ? ''
                        : 'El proyecto seleccionado no tiene indicadores disponibles.';

                    indicador.disabled = false;

                } catch (error) {
                    if (error.name === 'AbortError' || peticionActual !== peticion) return;

                    mostrarOpcion('No se pudieron cargar los indicadores');
                    mensaje.textContent =
                        'No fue posible cargar los indicadores. Intente nuevamente.';

                    reintentar.classList.remove('hidden');

                } finally {
                    if (peticionActual === peticion) {
                        indicador.setAttribute('aria-busy', 'false');
                    }
                }
            }

            proyecto.addEventListener('change', () => {
                indicador.dataset.selected = '';
                cargarIndicadores();
            });

            reintentar.addEventListener('click', cargarIndicadores);

            if (!proyecto.value || indicador.options.length <= 1) {
                cargarIndicadores();
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                inicializarFormularioAvance,
                { once: true }
            );
        } else {
            inicializarFormularioAvance();
        }
    })();
</script>