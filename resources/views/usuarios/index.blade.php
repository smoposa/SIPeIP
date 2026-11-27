<x-usuarios-layout title="Todos los Usuarios">
    <x-slot name="breadcrumbs">
        <nav aria-label="Migas de pan"><ol class="flex items-center text-xs"><li aria-current="page" class="font-medium text-gray-700">Usuarios</li></ol></nav>
    </x-slot>
    <div class="space-y-4">
        @if(session('success'))
            <div id="alertSuccess" role="status" class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">{{ session('success') }}</div>
            <script>setTimeout(() => document.getElementById('alertSuccess')?.remove(), 3000);</script>
        @endif
        <p class="text-sm text-gray-500">Consulte y administre los usuarios registrados en el sistema.</p>
        <form id="filtrosUsuarios" method="GET" action="{{ route('usuarios.index') }}" class="flex flex-wrap items-center gap-3">
            <input type="hidden" name="per_page" value="{{ $usuarios->perPage() }}">
            <div class="relative flex-1 min-w-40 max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="bi bi-search"></i></span>
                <input id="buscarUsuario" name="buscar" value="{{ $buscar }}" placeholder="Buscar usuario..." aria-label="Buscar usuario" class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm">
            </div>
            @if($esGlobal)
                <select name="entidad" aria-label="Filtrar por entidad" class="max-w-64 rounded-md border border-gray-300 px-3 py-2 text-sm">
                    <option value="">Todas las entidades</option>
                    @foreach($entidadesFiltro as $entidad)
                        <option value="{{ $entidad->id }}" @selected($filtroEntidad === (string) $entidad->id)>{{ $entidad->nombre }}</option>
                    @endforeach
                    <option value="sin_entidad" @selected($filtroEntidad === 'sin_entidad')>Sin entidad asignada</option>
                </select>
            @endif
            <select name="estado" aria-label="Filtrar por estado" class="rounded-md border border-gray-300 px-3 py-2 text-sm">
                <option value="">Todos los estados</option>
                <option value="Activo" @selected($estado === 'Activo')>Activos</option>
                <option value="Inactivo" @selected($estado === 'Inactivo')>Inactivos</option>
            </select>
            <div class="flex-1 text-sm text-gray-500 whitespace-nowrap"><span class="text-blue-600">{{ $totalUsuarios }}</span> registros · <span class="text-green-600">{{ $usuariosActivos }}</span> activos · <span class="text-red-600">{{ $usuariosInactivos }}</span> inactivos</div>
            @if(puedeHacer('usuarios', 'crear'))
                <button type="button" data-crear-usuario class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md whitespace-nowrap"><i class="bi bi-plus-lg"></i> Crear usuario</button>
            @endif
        </form>
        @include('usuarios.partials.listado-usuarios')
        @if(puedeHacer('usuarios', 'crear'))
            @include('usuarios.panel-crear')
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('filtrosUsuarios');
            let timer;
            form.querySelector('[name="buscar"]').addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(() => form.requestSubmit(), 600); });
            form.querySelectorAll('select').forEach(select => select.addEventListener('change', () => { clearTimeout(timer); form.requestSubmit(); }));
        });
    </script>
</x-usuarios-layout>
