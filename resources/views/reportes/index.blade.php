<x-planes-layout title="Reportes">
    <div class="mb-5">
        <h2 class="text-2xl font-semibold text-gray-800">Reportes</h2>
        <p class="text-sm text-gray-500">Consulta y exporta información de planificación, inversión y seguimiento de tu entidad.</p>
    </div>
    <form method="GET" action="{{ route('reportes.index') }}" class="mb-5 rounded-lg border border-gray-200 bg-white p-5">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <label class="block text-sm font-medium text-gray-700">Reporte
                <select name="tipo" class="mt-1 w-full rounded-md border-gray-300" onchange="this.form.submit()">
                    @foreach($tipos as $clave => $nombre)
                        <option value="{{ $clave }}" @selected($tipo === $clave)>{{ $nombre }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block text-sm font-medium text-gray-700">Año
                <input name="anio" type="number" min="2000" max="2100" value="{{ $filtros['anio'] ?? '' }}" class="mt-1 w-full rounded-md border-gray-300" placeholder="Todos">
            </label>
            @if(in_array($tipo, ['avances', 'presupuestos']))
                <label class="block text-sm font-medium text-gray-700">Período
                    <select name="periodo" class="mt-1 w-full rounded-md border-gray-300">
                        <option value="">Todos</option>
                        @foreach($periodos as $periodo)
                            <option value="{{ $periodo }}" @selected(($filtros['periodo'] ?? '') === $periodo)>{{ $periodo }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block text-sm font-medium text-gray-700">Proyecto
                    <select name="proyecto_id" class="mt-1 w-full rounded-md border-gray-300">
                        <option value="">Todos</option>
                        @foreach($proyectos as $proyecto)
                            <option value="{{ $proyecto->id }}" @selected((string)($filtros['proyecto_id'] ?? '') === (string)$proyecto->id)>{{ $proyecto->codigo }} - {{ $proyecto->nombre }}</option>
                        @endforeach
                    </select>
                </label>
            @endif
        </div>
        @if($errors->any())<p class="mt-3 text-sm text-red-700">{{ $errors->first() }}</p>@endif
        <div class="mt-4 flex flex-wrap gap-2">
            <button class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Consultar</button>
            <a href="{{ route('reportes.index', ['tipo' => $tipo]) }}" class="rounded-md border px-4 py-2 text-sm text-gray-700">Limpiar filtros</a>
            <a href="{{ route('reportes.excel', request()->only(['tipo', 'anio', 'periodo', 'proyecto_id'])) }}" class="rounded-md bg-green-700 px-4 py-2 text-sm font-medium text-white"><i class="bi bi-file-earmark-excel"></i> Excel</a>
            <a href="{{ route('reportes.pdf', request()->only(['tipo', 'anio', 'periodo', 'proyecto_id'])) }}" target="_blank" rel="noopener" class="rounded-md bg-[#024687] px-4 py-2 text-sm font-medium text-white"><i class="bi bi-file-earmark-pdf"></i> Ver PDF</a>
        </div>
    </form>
    <div class="mb-3 text-sm text-gray-600"><strong>{{ $registros->total() }}</strong> registros · {{ $tipos[$tipo] }}</div>
    <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50"><tr>
                <th class="px-3 py-3 text-left text-xs font-semibold uppercase text-gray-600">Nro.</th>
                @foreach($columnas as $columna)
                    <th class="px-3 py-3 text-left text-xs font-semibold uppercase text-gray-600">{{ $columna }}</th>
                @endforeach
            </tr></thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($registros as $registro)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 text-sm text-gray-500">{{ $registros->firstItem() + $loop->index }}</td>
                        @foreach($service->fila($tipo, $registro) as $valor)
                            <td class="px-3 py-3 text-sm text-gray-700">{{ is_float($valor) ? number_format($valor, 2, ',', '.') : ($valor ?? '—') }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr><td colspan="{{ count($columnas) + 1 }}" class="px-5 py-10 text-center text-gray-500">No hay registros para los filtros seleccionados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $registros->links() }}</div>
</x-planes-layout>
