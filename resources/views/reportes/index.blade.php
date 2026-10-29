@php
    $parametrosExportacion = [
        'tipo' => $tipo,
        'anio' => $filtros['anio'] ?? null,
    ];

    if (in_array($tipo, ['avances', 'presupuestos'], true)) {
        $parametrosExportacion['periodo'] = $filtros['periodo'] ?? null;
        $parametrosExportacion['proyecto_id'] = $filtros['proyecto_id'] ?? null;
    }

    $parametrosExportacion = array_filter(
        $parametrosExportacion,
        fn ($valor) => $valor !== null && $valor !== ''
    );
@endphp


<x-reportes-layout title="Consulta y exportación">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex items-center text-xs">

                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Reportes

                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <!-- Encabezado -->
        <div class="mb-4">

            <p class="mt-1 text-sm text-gray-500">
                Consulte y exporte información de planificación, inversión
                y seguimiento de su entidad.
            </p>

        </div>


        <!-- Filtros -->
        @include('reportes.partials.filtros')


        <!-- Resumen y exportación -->
        <div class="flex flex-wrap items-center justify-between gap-4">

            <!-- Resumen a la izquierda -->
            <div>

                <p class="text-sm text-gray-500">

                    <span class="font-medium text-blue-600">
                        {{ $registros->total() }}
                    </span>

                    registros · {{ $tipos[$tipo] }}

                </p>

                @if($registros->total() > 0)

                    <p class="mt-1 text-xs text-gray-500">
                        Mostrando {{ $registros->firstItem() }}
                        a {{ $registros->lastItem() }}
                    </p>

                @endif

            </div>


            <!-- Exportación a la derecha -->
            <div class="ml-auto flex flex-wrap items-center gap-2">

                <a href="{{ route('reportes.excel', $parametrosExportacion) }}"
                   class="inline-flex items-center gap-2 rounded-md bg-green-700
                          px-4 py-2 text-sm font-medium text-white
                          transition hover:bg-green-800">

                    <i class="bi bi-file-earmark-excel" aria-hidden="true"></i>
                    Excel

                </a>


                <a href="{{ route('reportes.pdf', $parametrosExportacion) }}"
                   target="_blank"
                   rel="noopener"
                   aria-label="Ver reporte PDF en una nueva pestaña"
                   class="inline-flex items-center gap-2 rounded-md bg-blue-800
                          px-4 py-2 text-sm font-medium text-white
                          transition hover:bg-blue-900">

                    <i class="bi bi-file-earmark-pdf" aria-hidden="true"></i>
                    Ver PDF

                </a>

            </div>

        </div>


        <!-- Tabla -->
        @include('reportes.partials.listado-registros')


        <!-- Paginación -->
        @if($registros->hasPages())

            <div class="mt-4">

                {{ $registros->appends(
                    request()->only(['tipo', 'anio', 'periodo', 'proyecto_id'])
                )->links() }}

            </div>

        @endif

    </div>

</x-reportes-layout>