<x-proyectos-layout title="Proyectos">

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

    {{-- Encabezado --}}
    <div class="mb-4 flex items-start justify-between gap-4">

        <div>
            <h2 class="text-2xl font-semibold text-gray-800">
                Proyectos de inversión pública
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Registro, clasificación y priorización de los proyectos
                pertenecientes a la entidad.
            </p>
        </div>

        @if (puedeHacer('proyectos', 'crear'))
            <a href="{{ route('proyectos.create') }}"
                class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">

                <i class="bi bi-plus-lg"></i>
                Crear proyecto
            </a>
        @endif

    </div>

    {{-- Resumen --}}
    <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <p class="text-xs font-medium uppercase text-gray-500">
                Total de proyectos
            </p>

            <p class="mt-1 text-2xl font-semibold text-gray-800">
                {{ $totalProyectos }}
            </p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <p class="text-xs font-medium uppercase text-gray-500">
                Activos
            </p>

            <p class="mt-1 text-2xl font-semibold text-green-700">
                {{ $totalActivos }}
            </p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <p class="text-xs font-medium uppercase text-gray-500">
                Inactivos
            </p>

            <p class="mt-1 text-2xl font-semibold text-red-700">
                {{ $totalInactivos }}
            </p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <p class="text-xs font-medium uppercase text-gray-500">
                Presupuesto registrado
            </p>

            <p class="mt-1 text-xl font-semibold text-blue-700">
                USD {{ number_format((float) $presupuestoTotal, 2) }}
            </p>
        </div>

    </div>

    {{-- Tabla --}}
    <div class="overflow-y-auto"
        style="height: calc(100vh - 310px);">

        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">

            <table class="min-w-full">

                <thead class="sticky top-0 z-10 border-b border-gray-200 bg-gray-50">

                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase text-gray-600">
                            Nro.
                        </th>

                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase text-gray-600">
                            Proyecto
                        </th>

                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase text-gray-600">
                            Clasificación
                        </th>

                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase text-gray-600">
                            Presupuesto
                        </th>

                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase text-gray-600">
                            Proceso
                        </th>

                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase text-gray-600">
                            Estado
                        </th>

                        <th class="px-3 py-3 text-right text-xs font-semibold uppercase text-gray-600">
                            Acciones
                        </th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($proyectos as $proyecto)

                        <tr class="border-b border-gray-100 align-top hover:bg-gray-50">

                            <td class="px-3 py-3 text-sm text-gray-500">
                                {{ ($proyectos->firstItem() ?? 1) + $loop->index }}
                            </td>

                            <td class="px-3 py-3">

                                <a href="{{ route('proyectos.detalle', $proyecto->id) }}"
                                    class="text-sm font-semibold text-blue-600 hover:text-blue-800 hover:underline">

                                    {{ $proyecto->codigo }}
                                    -
                                    {{ \Illuminate\Support\Str::limit(
                                        $proyecto->nombre,
                                        75
                                    ) }}
                                </a>

                                <p class="mt-1 text-xs text-gray-500">
                                    <span class="font-medium text-gray-600">
                                        Programa:
                                    </span>

                                    {{ $proyecto->programa?->codigo ?? 'No registra' }}
                                    -
                                    {{ $proyecto->programa?->nombre ?? 'No registra' }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    <span class="font-medium text-gray-600">
                                        Responsable:
                                    </span>

                                    {{ $proyecto->responsable?->nombres ?? 'No registra' }}
                                    {{ $proyecto->responsable?->apellidos ?? '' }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    <span class="font-medium text-gray-600">
                                        Ejecución:
                                    </span>

                                    {{ $proyecto->estado }}
                                </p>

                            </td>

                            <td class="px-3 py-3 text-sm text-gray-600">

                                <p class="font-medium text-gray-700">
                                    {{ $proyecto->subsector?->codigo ?? 'Sin código' }}
                                    -
                                    {{ $proyecto->subsector?->nombre ?? 'Sin subsector' }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $proyecto->subsector?->sector?->nombre ?? 'Sin sector' }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $proyecto->subsector?->sector?->macrosector?->nombre ?? 'Sin macrosector' }}
                                </p>

                            </td>

                            <td class="whitespace-nowrap px-3 py-3 text-sm font-medium text-gray-700">
                                USD {{ number_format(
                                    (float) $proyecto->presupuesto_aprobado,
                                    2
                                ) }}
                            </td>

                            <td class="px-3 py-3">

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
                                            'bg-gray-100 text-gray-700',
                                    };
                                @endphp

                                <span class="inline-flex rounded-full px-2 py-1 text-xs font-medium {{ $claseProceso }}">
                                    {{ $proyecto->estado_proceso }}
                                </span>

                            </td>

                            <td class="px-3 py-3">

                                @if ($proyecto->estado_administrativo === 'Activo')
                                    <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                                        Inactivo
                                    </span>
                                @endif

                            </td>

                            <td class="px-3 py-3 text-right">

                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('proyectos.detalle', $proyecto->id) }}"
                                        title="Ver detalle"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-gray-300 text-gray-600 transition hover:bg-gray-100">

                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @if (puedeHacer('proyectos', 'editar'))
                                        <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                                            title="Editar proyecto"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-blue-300 text-blue-600 transition hover:bg-blue-50">

                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="px-4 py-10 text-center text-sm text-gray-500">

                                No existen proyectos registrados para su entidad.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Paginación --}}
    <div class="mt-5 flex items-center justify-between gap-4">

        <p class="text-sm text-gray-600">
            Mostrando
            <span class="font-medium">
                {{ $proyectos->firstItem() ?? 0 }}
            </span>
            a
            <span class="font-medium">
                {{ $proyectos->lastItem() ?? 0 }}
            </span>
            de
            <span class="font-medium">
                {{ $proyectos->total() }}
            </span>
            registros.
        </p>

        {{ $proyectos->links() }}

    </div>

</x-proyectos-layout>