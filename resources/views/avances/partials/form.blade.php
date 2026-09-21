@php($registro = $avance ?? null)

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium text-gray-700">Proyecto <span class="text-red-600">*</span></label>
        <select id="proyecto_id" name="proyecto_id" required class="w-full rounded-md border-gray-300">
            <option value="">Seleccione un proyecto</option>
            @foreach ($proyectos as $proyecto)
                <option value="{{ $proyecto->id }}" @selected((string) old('proyecto_id', $registro?->proyecto_id ?? request('proyecto_id')) === (string) $proyecto->id)>
                    {{ $proyecto->codigo }} - {{ $proyecto->nombre }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('proyecto_id')" class="mt-1" />
    </div>

    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium text-gray-700">Indicador <span class="text-red-600">*</span></label>
        <select id="indicador_id" name="indicador_id" required class="w-full rounded-md border-gray-300" data-selected="{{ old('indicador_id', $registro?->indicador_id) }}">
            <option value="">Seleccione primero un proyecto</option>
            @foreach ($indicadores as $indicador)
                <option value="{{ $indicador->id }}" @selected((string) old('indicador_id', $registro?->indicador_id) === (string) $indicador->id)>
                    {{ $indicador->codigo }} - {{ $indicador->nombre }} ({{ $indicador->unidad_medida }})
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('indicador_id')" class="mt-1" />
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium text-gray-700">Año <span class="text-red-600">*</span></label>
        <input type="number" name="anio" min="2000" max="2100" required value="{{ old('anio', $registro?->anio ?? now()->year) }}" class="w-full rounded-md border-gray-300">
        <x-input-error :messages="$errors->get('anio')" class="mt-1" />
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium text-gray-700">Periodo <span class="text-red-600">*</span></label>
        <select name="periodo" required class="w-full rounded-md border-gray-300">
            @foreach ($periodos as $periodo)
                <option value="{{ $periodo->value }}" @selected(old('periodo', $registro?->periodo) === $periodo->value)>{{ $periodo->value }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium text-gray-700">Fecha de corte <span class="text-red-600">*</span></label>
        <input type="date" name="fecha_corte" required value="{{ old('fecha_corte', $registro?->fecha_corte?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" class="w-full rounded-md border-gray-300">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium text-gray-700">Estado <span class="text-red-600">*</span></label>
        <select name="estado" required class="w-full rounded-md border-gray-300">
            @foreach ($estados as $estado)
                <option value="{{ $estado->value }}" @selected(old('estado', $registro?->estado ?? 'Borrador') === $estado->value)>{{ $estado->value }}</option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-gray-500">Al cerrar el registro ya no podrá editarse.</p>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium text-gray-700">Valor programado <span class="text-red-600">*</span></label>
        <input type="number" step="0.0001" min="0.0001" name="valor_programado" required value="{{ old('valor_programado', $registro?->valor_programado) }}" class="w-full rounded-md border-gray-300">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium text-gray-700">Valor ejecutado <span class="text-red-600">*</span></label>
        <input type="number" step="0.0001" min="0" name="valor_ejecutado" required value="{{ old('valor_ejecutado', $registro?->valor_ejecutado) }}" class="w-full rounded-md border-gray-300">
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium text-gray-700">Resultado alcanzado</label>
        <textarea name="resultado" rows="3" class="w-full rounded-md border-gray-300">{{ old('resultado', $registro?->resultado) }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium text-gray-700">Observaciones</label>
        <textarea name="observaciones" rows="3" class="w-full rounded-md border-gray-300">{{ old('observaciones', $registro?->observaciones) }}</textarea>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const proyecto = document.getElementById('proyecto_id');
    const indicador = document.getElementById('indicador_id');
    const plantilla = @json(route('avances.indicadores', ['proyecto' => '__ID__']));
    const cargar = async () => {
        const seleccionado = indicador.dataset.selected;
        indicador.innerHTML = '<option value="">Cargando indicadores...</option>';
        if (!proyecto.value) { indicador.innerHTML = '<option value="">Seleccione primero un proyecto</option>'; return; }
        const respuesta = await fetch(plantilla.replace('__ID__', proyecto.value), {headers: {'Accept': 'application/json'}});
        const datos = await respuesta.json();
        indicador.innerHTML = '<option value="">Seleccione un indicador</option>' + datos.map(item =>
            `<option value="${item.id}" ${String(item.id) === String(seleccionado) ? 'selected' : ''}>${item.codigo} - ${item.nombre} (${item.unidad_medida})</option>`
        ).join('');
    };
    proyecto.addEventListener('change', () => { indicador.dataset.selected = ''; cargar(); });
    if (proyecto.value && indicador.options.length <= 1) cargar();
});
</script>
