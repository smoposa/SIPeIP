<x-catalogos-layout title="Agendas ODS">
    <x-slot name="breadcrumbs"><nav aria-label="Migas de pan" class="text-xs">Agendas ODS</nav></x-slot>
    <div class="space-y-4">
        @include('ods.partials.avisos')
        
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <form id="filtrosAgendas" method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-center gap-4 flex-1">
                <input type="hidden" name="per_page" value="{{ $agendas->perPage() }}">
                <div class="relative flex-1 max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscarAgenda" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar agenda..." class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm">
                </div>
                <select id="filtroEstadoAgenda" name="estado" class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm">
                    <option value="">Todos los estados</option>
                    <option value="Activo" @selected(request('estado') === 'Activo')>Activos</option>
                    <option value="Inactivo" @selected(request('estado') === 'Inactivo')>Inactivos</option>
                </select>
                <p class="text-sm text-gray-500"><span class="text-blue-600 font-medium">{{ $agendas->total() }}</span> registros encontrados</p>
            </form>
            @if(puedeHacer('ods', 'crear'))
                <button type="button" id="crearAgenda" aria-haspopup="dialog" aria-controls="panelAgenda" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md"><i class="bi bi-plus-lg"></i> Crear agenda</button>
            @endif
        </div>
        <div id="gestionAgendas">
            @include('ods.agendas.partials.listado-agendas')
            @include('ods.agendas.partials.panel-editar-agenda')
        </div>
        @include('ods.agendas.partials.scripts-agendas')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('filtrosAgendas');
                let timer;
                document.getElementById('buscarAgenda').addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(() => form.requestSubmit(), 600); });
                document.getElementById('filtroEstadoAgenda').addEventListener('change', () => { clearTimeout(timer); form.requestSubmit(); });
            });
        </script>
    </div>
</x-catalogos-layout>
