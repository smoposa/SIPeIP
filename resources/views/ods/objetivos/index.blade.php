<x-catalogos-layout :title="'Objetivos  ' . $agenda->nombre">
    <x-slot name="breadcrumbs"><nav aria-label="Migas de pan" class="text-xs"><a href="{{ route('ods.agendas.index') }}" class="text-blue-600">Agendas ODS</a> <i class="bi bi-chevron-right"></i> {{ $agenda->nombre }} <i class="bi bi-chevron-right"></i> Objetivos</nav></x-slot>
    <div class="space-y-4">
        @include('ods.partials.avisos')
        <div class="bg-white border-b border-gray-300 flex gap-8"><a href="{{ route('ods.agendas.index') }}" class="py-2 text-sm text-blue-600"><i class="bi bi-chevron-left"></i> Regresar</a><a href="{{ url()->current() }}" class="py-2 text-sm text-gray-700"><i class="bi bi-arrow-clockwise"></i> Actualizar</a></div>
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <form id="filtrosObjetivos" method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-center gap-4 flex-1">
                <input type="hidden" name="per_page" value="{{ $ods->perPage() }}">
                <div class="relative flex-1 max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscarObjetivo" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar objetivo..." class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm">
                </div>
                <select id="filtroEstadoObjetivo" name="estado" class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm">
                    <option value="">Todos los estados</option>
                    <option value="Activo" @selected(request('estado') === 'Activo')>Activos</option>
                    <option value="Inactivo" @selected(request('estado') === 'Inactivo')>Inactivos</option>
                </select>
                <p class="text-sm text-gray-500"><span class="text-blue-600 font-medium">{{ $ods->total() }}</span> registros encontrados</p>
            </form>
            @if(puedeHacer('ods', 'crear'))
                <button type="button" id="registrarObjetivo" aria-haspopup="dialog" aria-controls="panelObjetivo" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md"><i class="bi bi-plus-lg"></i> Registrar objetivo</button>
            @endif
        </div>
        <div id="gestionObjetivos">
            @include('ods.objetivos.partials.listado-objetivos')
            @include('ods.objetivos.partials.panel-editar-objetivo')
        </div>
        @include('ods.objetivos.partials.scripts-objetivos')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('filtrosObjetivos');
                let timer;
                document.getElementById('buscarObjetivo').addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(() => form.requestSubmit(), 600); });
                document.getElementById('filtroEstadoObjetivo').addEventListener('change', () => { clearTimeout(timer); form.requestSubmit(); });
            });
        </script>
    </div>
</x-catalogos-layout>
