<!-- Información general -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información general
        </h4>

        @if($avance->estado === 'Borrador' && puedeHacer('avances', 'editar'))

            <a href="{{ route('avances.edit', $avance) }}"
               class="text-sm text-blue-600 hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>


<!-- Datos del avance -->
<div class="px-4 py-5">

    <div class="min-w-0 space-y-5">

        <!-- Código del proyecto -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Código del proyecto
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $avance->proyecto?->codigo ?? 'No registra' }}
            </span>

        </div>


        <!-- Nombre del proyecto -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre del proyecto
            </span>

            <span class="min-w-0 flex-1 break-words text-sm font-medium text-[#0F766E]">
                {{ $avance->proyecto?->nombre ?? 'No registra' }}
            </span>

        </div>


        <!-- Código del indicador -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Código del indicador
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $avance->indicador?->codigo ?? 'No registra' }}
            </span>

        </div>


        <!-- Nombre del indicador -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre del indicador
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $avance->indicador?->nombre ?? 'No registra' }}
            </span>

        </div>


        <!-- Unidad de medida -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Unidad de medida
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $avance->indicador?->unidad_medida ?? 'No registra' }}
            </span>

        </div>


        <!-- Año -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Año
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $avance->anio }}
            </span>

        </div>


        <!-- Período -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Período
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $avance->periodo }}
            </span>

        </div>


        <!-- Fecha de corte -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Fecha de corte
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $avance->fecha_corte?->format('d/m/Y') ?? 'No registra' }}
            </span>

        </div>

    </div>

</div>