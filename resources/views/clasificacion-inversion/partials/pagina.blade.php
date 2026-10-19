@php
    $esMacrosector = $nivel === 'macrosector';
    $esSector = $nivel === 'sector';
    $esSubsector = $nivel === 'subsector';

    $etiqueta = match ($nivel) {
        'macrosector' => 'Macrosector',
        'sector' => 'Sector',
        'subsector' => 'Subsector',
    };

    $plural = match ($nivel) {
        'macrosector' => 'Macrosectores',
        'sector' => 'Sectores',
        'subsector' => 'Subsectores',
    };

    $referencia = $esMacrosector
        ? 'Clasificación de la inversión'
        : ($esSector ? $macrosector->nombre : $sector->nombre);

    $puedeRegistrar = $esMacrosector || ($esSector
        ? $macrosector->estado === 'Activo'
        : $sector->estado === 'Activo' && $sector->macrosector->estado === 'Activo');
@endphp

<x-catalogos-layout :title="$titulo">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">
        <nav aria-label="Migas de pan">
            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs">
                @if($esMacrosector)
                    <li aria-current="page" class="font-medium text-gray-700">Clasificación de la inversión</li>
                @else
                    <li>
                        <a href="{{ route('clasificacion-inversion.index') }}"
                           class="text-blue-600 hover:text-blue-800 hover:underline">Clasificación de la inversión</a>
                    </li>
                    <li aria-hidden="true"><i class="bi bi-chevron-right"></i></li>

                    @if($esSubsector)
                        <li>
                            <a href="{{ route('clasificacion-inversion.sectores.index', ['macrosector' => $sector->macrosector_id]) }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">{{ $sector->macrosector->nombre }}</a>
                        </li>
                        <li aria-hidden="true"><i class="bi bi-chevron-right"></i></li>
                    @endif

                    <li class="break-words">{{ $referencia }}</li>
                    <li aria-hidden="true"><i class="bi bi-chevron-right"></i></li>
                    <li aria-current="page" class="font-medium text-gray-700">{{ $plural }}</li>
                @endif
            </ol>
        </nav>
    </x-slot>

    <div id="gestionClasificacion" class="space-y-4">

        @include('clasificacion-inversion.partials.avisos')

        @if(!$esMacrosector)
        <!-- Barra de acciones -->
        <div class="bg-white border-b border-gray-300 mb-0">
            <div class="flex overflow-x-auto">
                @unless($esMacrosector)
                    <a href="{{ $esSector
                        ? route('clasificacion-inversion.index')
                        : route('clasificacion-inversion.sectores.index', ['macrosector' => $sector->macrosector_id]) }}"
                       class="shrink-0 py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">
                        <i class="bi bi-chevron-left" aria-hidden="true"></i>
                        Regresar
                    </a>
                @endunless

                <a href="{{ url()->current() }}"
                   class="shrink-0 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                    <i class="bi bi-arrow-clockwise text-blue-500 me-2" aria-hidden="true"></i>
                    Actualizar
                </a> 
            </div>
        </div>
        @endif

        <p class="text-sm text-gray-500">
            @if($esMacrosector)
                Consulte y administre los macrosectores de la clasificación de la inversión.
            @else
                Consulte y administre los {{ strtolower($plural) }} registrados en {{ $referencia }}.
            @endif
        </p>

        <!-- Buscador, filtro, resumen y registro -->
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <div class="relative flex-1 max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="bi bi-search" aria-hidden="true"></i>
                </span>
                <input type="text" id="buscarClasificacion"
                       placeholder="Buscar {{ strtolower($etiqueta) }}..."
                       aria-label="Buscar {{ strtolower($etiqueta) }}"
                       class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                              focus:ring-blue-500 focus:border-blue-500">
            </div>

            <select id="filtroEstadoClasificacion" aria-label="Filtrar por estado"
                    class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-700
                           focus:border-blue-500 focus:ring-blue-500">
                <option value="">Todos los estados</option>
                <option value="Activo">Activos</option>
                <option value="Inactivo">Inactivos</option>
            </select>

            <div class="flex-1">
                <p class="text-sm text-gray-500">
                    <span class="text-blue-600 font-medium">{{ $registros->count() }}</span> registros ·
                    <span class="text-green-600 font-medium">{{ $registros->where('estado', 'Activo')->count() }}</span> activos ·
                    <span class="text-red-600 font-medium">{{ $registros->where('estado', 'Inactivo')->count() }}</span> inactivos
                </p>
            </div>

            @if(puedeHacer('clasificacion_inversion', 'crear'))
                <button type="button" id="registrarClasificacion"
                        aria-haspopup="dialog" aria-controls="panelClasificacion"
                        @disabled(!$puedeRegistrar)
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white
                               text-sm font-medium px-4 py-2 rounded-md transition whitespace-nowrap
                               disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Registrar {{ strtolower($etiqueta) }}
                </button>
            @endif
        </div>

        @if(!$puedeRegistrar)
            <p class="text-xs text-amber-700">
                Los registros se conservan para consulta. Para registrar nuevos elementos,
                active primero los niveles superiores de esta clasificación.
            </p>
        @endif

        <!-- Listado correspondiente al nivel actual -->
        @include('clasificacion-inversion.' . match ($nivel) {
            'macrosector' => 'macrosectores',
            'sector' => 'sectores',
            'subsector' => 'subsectores',
        } . '.partials.listado')

        @include('clasificacion-inversion.partials.panel')
        @include('clasificacion-inversion.partials.scripts')

    </div>
</x-catalogos-layout>
