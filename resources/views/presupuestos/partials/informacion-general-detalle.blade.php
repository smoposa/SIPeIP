<!-- Información general -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información general
        </h4>

        @if($presupuesto->estado === 'Borrador' && puedeHacer('presupuestos', 'editar'))

            <a href="{{ route('presupuestos.edit', $presupuesto) }}"
               class="text-sm text-blue-600 hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>


<!-- Datos del presupuesto -->
<div class="px-4 py-5">

    <div class="min-w-0 space-y-5">

        <!-- Código del proyecto -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Código del proyecto
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $presupuesto->proyecto?->codigo ?? 'No registra' }}
            </span>

        </div>


        <!-- Nombre del proyecto -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre del proyecto
            </span>

            <span class="min-w-0 flex-1 break-words text-sm font-medium text-[#0F766E]">
                {{ $presupuesto->proyecto?->nombre ?? 'No registra' }}
            </span>

        </div>


        <!-- Año -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Año
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $presupuesto->anio }}
            </span>

        </div>


        <!-- Período -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Período
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $presupuesto->periodo }}
            </span>

        </div>


        <!-- Fecha de corte -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Fecha de corte
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $presupuesto->fecha_corte?->format('d/m/Y') ?? 'No registra' }}
            </span>

        </div>

    </div>

</div>