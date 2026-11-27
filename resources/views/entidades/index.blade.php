<x-entidades-layout title="Todas las Entidades">
    <x-slot name="breadcrumbs">
        <nav aria-label="Migas de pan">
            <ol class="flex items-center text-xs">
                <li aria-current="page" class="font-medium text-gray-700">Entidades</li>
            </ol>
        </nav>
    </x-slot>

    <div class="space-y-4">
        @if(session('success'))
            <div id="alertSuccess" role="status" class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                {{ session('success') }}
            </div>
            <script>setTimeout(() => document.getElementById('alertSuccess')?.remove(), 3000);</script>
        @endif

        <div class="mb-4">
            <p class="mt-1 text-sm text-gray-500">Consulte y administre las entidades registradas en el sistema.</p>
        </div>

        <form method="GET" action="{{ route('entidades.index') }}" id="filtrosEntidades" class="flex flex-wrap items-center gap-4 mb-4">
            <input type="hidden" name="per_page" value="{{ $entidades->perPage() }}">
            <div class="relative flex-1 max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="bi bi-search" aria-hidden="true"></i></span>
                <input type="text" id="buscarEntidad" name="buscar" value="{{ request()->string('buscar') }}" placeholder="Buscar entidad..." aria-label="Buscar entidad" class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <select id="filtroEstado" name="estado" aria-label="Filtrar entidades por estado" class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:ring-blue-500">
                <option value="">Todos los estados</option>
                <option value="Activo" @selected(request('estado') === 'Activo')>Activas</option>
                <option value="Inactivo" @selected(request('estado') === 'Inactivo')>Inactivas</option>
            </select>
            <div class="flex-1">
                <p class="text-sm text-gray-500">
                    <span class="text-blue-600 font-medium">{{ $totalEntidades }}</span> registros ·
                    <span class="text-green-600 font-medium">{{ $entidadesActivas }}</span> activas ·
                    <span class="text-red-600 font-medium">{{ $entidadesInactivas }}</span> inactivas
                </p>
            </div>
            @if(puedeHacer('entidades', 'crear'))
                <button type="button" data-crear-entidad class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition whitespace-nowrap">
                    <i class="bi bi-plus-lg" aria-hidden="true"></i> Crear entidad
                </button>
            @endif
        </form>

        @include('entidades.partials.listado-entidades')

        @if(puedeHacer('entidades', 'crear'))
            @include('entidades.crear')
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const formulario = document.getElementById('filtrosEntidades');
                const buscador = document.getElementById('buscarEntidad');
                const filtro = document.getElementById('filtroEstado');
                let temporizador;
                buscador.addEventListener('input', function () {
                    clearTimeout(temporizador);
                    temporizador = setTimeout(() => formulario.requestSubmit(), 600);
                });
                filtro.addEventListener('change', function () {
                    clearTimeout(temporizador);
                    formulario.requestSubmit();
                });
            });
        </script>
    </div>
</x-entidades-layout>
