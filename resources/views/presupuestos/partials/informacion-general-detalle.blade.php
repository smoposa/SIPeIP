<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="flex justify-between items-center px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información general
        </h4>

        @if($presupuesto->estado === 'Borrador' && puedeHacer('presupuestos', 'editar'))

            <a href="{{ route('presupuestos.edit', $presupuesto) }}"
               class="text-sm text-blue-600 hover:text-blue-800">
                Editar
            </a>

        @endif

    </div>

</div>


<!-- Información -->
<div class="px-4 py-2">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 mb-6">

        <!-- Columna izquierda -->
        <div class="space-y-4">

            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Proyecto
                </span>

                <span class="min-w-0 break-words text-sm text-gray-600">

                    {{ $presupuesto->proyecto?->codigo ?? 'No registra' }}

                    @if($presupuesto->proyecto?->nombre)
                        - {{ $presupuesto->proyecto->nombre }}
                    @endif

                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Año
                </span>

                <span class="text-sm text-gray-600">
                    {{ $presupuesto->anio }}
                </span>

            </div>

        </div>


        <!-- Columna derecha -->
        <div class="space-y-4">

            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Período
                </span>

                <span class="text-sm text-gray-600">
                    {{ $presupuesto->periodo }}
                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Fecha de corte
                </span>

                <span class="text-sm text-gray-600">
                    {{ $presupuesto->fecha_corte?->format('d/m/Y') ?? 'No registra' }}
                </span>

            </div>

        </div>

    </div>

</div>