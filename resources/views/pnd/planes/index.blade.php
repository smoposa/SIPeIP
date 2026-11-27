<x-catalogos-layout title="Planes Nacionales de Desarrollo">
    <x-slot name="breadcrumbs"><nav aria-label="Migas de pan" class="text-xs">Planes Nacionales de Desarrollo</nav></x-slot>
    <div class="space-y-4">
        @include('pnd.partials.avisos')
        
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <form id="filtrosPlanes" method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-center gap-4 flex-1">
                <input type="hidden" name="per_page" value="{{ $planes->perPage() }}">
                <div class="relative flex-1 max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscarPlanServidor" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar plan nacional..." class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm">
                </div>
                <select id="filtroEstadoServidor" name="estado" class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm">
                    <option value="">Todos los estados</option>
                    <option value="Activo" @selected(request('estado') === 'Activo')>Activos</option>
                    <option value="Inactivo" @selected(request('estado') === 'Inactivo')>Inactivos</option>
                </select>
                <p class="text-sm text-gray-500"><span class="text-blue-600 font-medium">{{ $planes->total() }}</span> registros encontrados</p>
            </form>
            @if(puedeHacer('pnd', 'crear'))
                <button type="button" id="registrarPlanPnd" aria-haspopup="dialog" aria-controls="panelPlanPnd" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md"><i class="bi bi-plus-lg"></i> Registrar plan</button>
            @endif
        </div>
        <div id="gestionPlanesPnd">
            @include('pnd.planes.partials.listado-planes')
            @include('pnd.planes.partials.panel-editar-plan')
        </div>
        <div hidden><input id="buscarPlanPnd" type="text"><select id="filtroEstadoPnd"><option value=""></option></select></div>
        @include('pnd.planes.partials.scripts-planes')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('filtrosPlanes');
                let timer;
                document.getElementById('buscarPlanServidor').addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(() => form.requestSubmit(), 600); });
                document.getElementById('filtroEstadoServidor').addEventListener('change', () => { clearTimeout(timer); form.requestSubmit(); });
            });
        </script>
    </div>
</x-catalogos-layout>
