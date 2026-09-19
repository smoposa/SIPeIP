<x-proyectos-layout title="Detalle del Proyecto">

    @if (session('success'))
        <div id="alertSuccess"
            class="fixed right-5 top-5 z-50 rounded-lg bg-green-600 px-6 py-3 text-white shadow-lg">

            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                document.getElementById('alertSuccess')?.remove();
            }, 3000);
        </script>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded-md border border-red-300 bg-red-50 p-4">

            <h3 class="mb-2 text-sm font-semibold text-red-800">
                Se encontraron los siguientes errores:
            </h3>

            <ul class="list-inside list-disc text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    {{-- Barra superior --}}
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3 border-b border-gray-200 bg-white pb-3">

        <a href="{{ route('proyectos.listar') }}"
            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">

            <i class="bi bi-chevron-left mr-1"></i>
            Regresar
        </a>

        <div class="flex items-center gap-2">

            @if (puedeHacer('proyectos', 'editar'))
                <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                    class="inline-flex items-center rounded-md border border-blue-300 px-4 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-50">

                    <i class="bi bi-pencil mr-2"></i>
                    Editar proyecto
                </a>
            @endif

            <a href="{{ url()->current() }}"
                class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">

                <i class="bi bi-arrow-clockwise mr-2"></i>
                Actualizar
            </a>

        </div>

    </div>

    <div class="overflow-y-auto"
        style="height: calc(100vh - 175px);">

        {{-- Cabecera --}}
        <div class="mb-5 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-blue-600 text-2xl text-white">
                    <i class="bi bi-kanban"></i>
                </div>

                <div class="min-w-0">

                    <p class="text-sm font-medium text-blue-600">
                        {{ $proyecto->codigo }}
                    </p>

                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $proyecto->nombre }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $proyecto->entidad?->nombre ?? 'Entidad no registrada' }}
                    </p>

                </div>

            </div>

        </div>

        {{-- Estados --}}
        <div class="mb-5 rounded-lg border border-gray-200 bg-white p-6">

            <h3 class="mb-5 text-lg font-semibold text-gray-800">
                Estados del proyecto
            </h3>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Ejecución --}}
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Estado de ejecución
                    </p>

                    @php
                        $claseEjecucion = match ($proyecto->estado) {
                            'En ejecución' =>
                                'bg-blue-100 text-blue-700',

                            'Finalizado' =>
                                'bg-green-100 text-green-700',

                            'Suspendido' =>
                                'bg-red-100 text-red-700',

                            default =>
                                'bg-gray-200 text-gray-700',
                        };
                    @endphp

                    <span class="mt-2 inline-flex rounded-full px-3 py-1 text-sm font-medium {{ $claseEjecucion }}">
                        {{ $proyecto->estado }}
                    </span>

                    <p class="mt-2 text-xs text-gray-500">
                        Se actualiza desde la edición del proyecto.
                    </p>

                </div>

                {{-- Administrativo --}}
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Estado administrativo
                    </p>

                    @if ($proyecto->estado_administrativo === 'Activo')
                        <span class="mt-2 inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">
                            Activo
                        </span>
                    @else
                        <span class="mt-2 inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-700">
                            Inactivo
                        </span>
                    @endif

                    @if (puedeHacer('proyectos', 'estado'))
                        <form method="POST"
                            action="{{ route('proyectos.estado', $proyecto->id) }}"
                            class="mt-3">

                            @csrf
                            @method('PUT')

                            <input type="hidden"
                                name="estado"
                                value="{{ $proyecto->estado_administrativo === 'Activo'
                                    ? 0
                                    : 1 }}">

                            <button type="submit"
                                class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">

                                {{ $proyecto->estado_administrativo === 'Activo'
                                    ? 'Inactivar proyecto'
                                    : 'Activar proyecto' }}
                            </button>

                        </form>
                    @endif

                </div>

                {{-- Proceso --}}
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">

                    <p class="text-xs font-medium uppercase text-gray-500">
                        Proceso de priorización
                    </p>

                    @php
                        $claseProceso = match (
                            $proyecto->estado_proceso
                        ) {
                            'Priorizado' =>
                                'bg-green-100 text-green-700',

                            'Observado' =>
                                'bg-amber-100 text-amber-700',

                            'Negado' =>
                                'bg-red-100 text-red-700',

                            'En revisión' =>
                                'bg-blue-100 text-blue-700',

                            default =>
                                'bg-gray-200 text-gray-700',
                        };
                    @endphp

                    <span class="mt-2 inline-flex rounded-full px-3 py-1 text-sm font-medium {{ $claseProceso }}">
                        {{ $proyecto->estado_proceso }}
                    </span>

                    @if (puedeHacer('proyectos', 'proceso'))
                        <form method="POST"
                            action="{{ route(
                                'proyectos.estado-proceso',
                                $proyecto->id
                            ) }}"
                            class="mt-3">

                            @csrf
                            @method('PUT')

                            <div class="flex gap-2">

                                <select
                                    name="estado_proceso"
                                    class="min-w-0 flex-1 rounded-md border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                    @foreach ($estadosProceso as $estadoProceso)
                                        <option
                                            value="{{ $estadoProceso->value }}"
                                            @selected(
                                                old(
                                                    'estado_proceso',
                                                    $proyecto->estado_proceso
                                                ) === $estadoProceso->value
                                            )>

                                            {{ $estadoProceso->value }}
                                        </option>
                                    @endforeach

                                </select>

                                <button type="submit"
                                    class="rounded-md bg-blue-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-blue-700">

                                    Guardar
                                </button>

                            </div>

                        </form>
                    @endif

                </div>

            </div>

        </div>

        {{-- Información general --}}
        <div class="mb-5 rounded-lg border border-gray-200 bg-white">

            <div class="border-b border-gray-200 bg-gray-50 px-5 py-3">
                <h3 class="text-sm font-semibold text-gray-800">
                    Información general
                </h3>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-5 md:grid-cols-2">

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Programa
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->programa?->codigo ?? 'No registra' }}
                        -
                        {{ $proyecto->programa?->nombre ?? 'No registra' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Responsable
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->responsable?->nombres ?? 'No registra' }}
                        {{ $proyecto->responsable?->apellidos ?? '' }}

                        @if ($proyecto->responsable?->cargo)
                            - {{ $proyecto->responsable->cargo }}
                        @endif
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Período de ejecución
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->fecha_inicio?->format('d/m/Y') }}
                        al
                        {{ $proyecto->fecha_fin?->format('d/m/Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Presupuesto aprobado
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-800">
                        USD {{ number_format(
                            (float) $proyecto->presupuesto_aprobado,
                            2
                        ) }}
                    </p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Descripción
                    </p>

                    <p class="mt-1 whitespace-pre-line text-sm leading-relaxed text-gray-700">{{ $proyecto->descripcion ?: 'No registra' }}</p>
                </div>

            </div>

        </div>

        {{-- Clasificación --}}
        <div class="mb-5 rounded-lg border border-gray-200 bg-white">

            <div class="border-b border-gray-200 bg-gray-50 px-5 py-3">
                <h3 class="text-sm font-semibold text-gray-800">
                    Clasificación de la intervención
                </h3>
            </div>

            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-3">

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Macrosector
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->subsector?->sector?->macrosector?->nombre
                            ?? 'No registra' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Sector
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->subsector?->sector?->nombre
                            ?? 'No registra' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Subsector
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->subsector?->codigo ?? 'No registra' }}
                        -
                        {{ $proyecto->subsector?->nombre ?? 'No registra' }}
                    </p>
                </div>

            </div>

        </div>

        {{-- Alineación estratégica --}}
        <div class="mb-5 rounded-lg border border-gray-200 bg-white">

            <div class="border-b border-gray-200 bg-gray-50 px-5 py-3">
                <h3 class="text-sm font-semibold text-gray-800">
                    Alineación estratégica mediante el programa
                </h3>
            </div>

            <div class="p-5">

                @forelse ($proyecto->programa?->objetivos ?? [] as $objetivo)

                    <div class="border-b border-gray-100 py-3 first:pt-0 last:border-b-0 last:pb-0">

                        <p class="text-sm font-medium text-gray-800">
                            {{ $objetivo->codigo }}
                            -
                            {{ $objetivo->nombre }}
                        </p>

                        @if ($objetivo->plan)
                            <p class="mt-1 text-xs text-gray-500">
                                Plan:
                                {{ $objetivo->plan->codigo }}
                                -
                                {{ $objetivo->plan->nombre }}
                            </p>
                        @endif

                    </div>

                @empty

                    <p class="text-sm text-gray-500">
                        El programa no tiene objetivos estratégicos asociados.
                    </p>

                @endforelse

            </div>

        </div>

        {{-- Trazabilidad --}}
        <div class="mb-6 rounded-lg border border-gray-200 bg-white">

            <div class="border-b border-gray-200 bg-gray-50 px-5 py-3">
                <h3 class="text-sm font-semibold text-gray-800">
                    Trazabilidad del registro
                </h3>
            </div>

            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-3">

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Registrado por
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->usuario?->nombres ?? 'No registra' }}
                        {{ $proyecto->usuario?->apellidos ?? '' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Fecha de creación
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->created_at?->format('d/m/Y H:i')
                            ?? 'No registra' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase text-gray-500">
                        Última actualización
                    </p>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ $proyecto->updated_at?->format('d/m/Y H:i')
                            ?? 'No registra' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</x-proyectos-layout>