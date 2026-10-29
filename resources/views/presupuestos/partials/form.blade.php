@php
    $registro = $presupuesto ?? null;

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

                <option
                    value="{{ $proyecto->id }}"
                    data-aprobado="{{ $proyecto->presupuesto_aprobado }}"
                    @selected(
                        (string) old('proyecto_id', $registro?->proyecto_id ?? request('proyecto_id'))
                        === (string) $proyecto->id
                    )>

                    {{ $proyecto->codigo }} - {{ $proyecto->nombre }}
                    | Aprobado: USD {{ number_format((float) $proyecto->presupuesto_aprobado, 2) }}

                </option>

            @endforeach

        </select>

        <x-input-error :messages="$errors->get('proyecto_id')" class="mt-1" />

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
                aria-describedby="ayudaEstadoPresupuesto"
                class="{{ $claseCampo }}">

            @foreach($estados as $estado)

                <option value="{{ $estado->value }}"
                    @selected(old('estado', $registro?->estado ?? 'Borrador') === $estado->value)>
                    {{ $estado->value }}
                </option>

            @endforeach

        </select>

        <p id="ayudaEstadoPresupuesto" class="mt-1 text-xs text-gray-500">
            Al cerrar el registro ya no podrá editarse.
        </p>

        <x-input-error :messages="$errors->get('estado')" class="mt-1" />

    </div>


    <!-- Monto programado -->
    <div>

        <label for="monto_programado" class="mb-1 block text-sm font-medium text-gray-700">
            Monto programado (USD) <span class="text-red-600">*</span>
        </label>

        <input type="number"
               id="monto_programado"
               name="monto_programado"
               step="0.01"
               min="0.01"
               required
               value="{{ old('monto_programado', $registro?->monto_programado) }}"
               class="{{ $claseCampo }}">

        <x-input-error :messages="$errors->get('monto_programado')" class="mt-1" />

    </div>


    <!-- Presupuesto vigente -->
    <div>

        <label for="presupuesto_vigente" class="mb-1 block text-sm font-medium text-gray-700">
            Presupuesto vigente (USD) <span class="text-red-600">*</span>
        </label>

        <input type="number"
               id="presupuesto_vigente"
               name="presupuesto_vigente"
               step="0.01"
               min="0"
               required
               value="{{ old('presupuesto_vigente', $registro?->presupuesto_vigente) }}"
               class="{{ $claseCampo }}">

        <x-input-error :messages="$errors->get('presupuesto_vigente')" class="mt-1" />

    </div>


    <!-- Monto ejecutado -->
    <div>

        <label for="monto_ejecutado" class="mb-1 block text-sm font-medium text-gray-700">
            Monto ejecutado (USD) <span class="text-red-600">*</span>
        </label>

        <input type="number"
               id="monto_ejecutado"
               name="monto_ejecutado"
               step="0.01"
               min="0"
               required
               value="{{ old('monto_ejecutado', $registro?->monto_ejecutado) }}"
               class="{{ $claseCampo }}">

        <x-input-error :messages="$errors->get('monto_ejecutado')" class="mt-1" />

    </div>


    <!-- Presupuesto aprobado -->
    <div class="rounded-md border border-blue-200 bg-blue-50 p-4">

        <p class="text-sm font-medium text-blue-800">
            Presupuesto aprobado del proyecto
        </p>

        <p id="aprobadoProyecto"
           role="status"
           aria-live="polite"
           class="mt-1 text-lg font-semibold text-blue-700">
            Seleccione un proyecto
        </p>

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
        function inicializarFormularioPresupuesto() {
            const proyecto = document.getElementById('proyecto_id');
            const vigente = document.getElementById('presupuesto_vigente');
            const aprobado = document.getElementById('aprobadoProyecto');

            if (!proyecto || !vigente || !aprobado) return;

            const formato = new Intl.NumberFormat('es-EC', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            function actualizarPresupuesto() {
                const opcion = proyecto.options[proyecto.selectedIndex];
                const valor = opcion?.dataset.aprobado;

                if (!proyecto.value) {
                    aprobado.textContent = 'Seleccione un proyecto';
                    return;
                }

                if (valor == null || valor.trim() === '') {
                    aprobado.textContent = 'No registra';
                    return;
                }

                const monto = Number(valor);

                if (!Number.isFinite(monto)) {
                    aprobado.textContent = 'No registra';
                    return;
                }

                aprobado.textContent = 'USD ' + formato.format(monto);

                // Conserva valores existentes, incluido cero.
                if (vigente.value === '') {
                    vigente.value = monto.toFixed(2);
                }
            }

            proyecto.addEventListener('change', actualizarPresupuesto);

            actualizarPresupuesto();
        }

        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                inicializarFormularioPresupuesto,
                { once: true }
            );
        } else {
            inicializarFormularioPresupuesto();
        }
    })();
</script>