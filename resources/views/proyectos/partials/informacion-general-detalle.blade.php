<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="flex justify-between items-center px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información general
        </h4>

        @if(puedeHacer('proyectos', 'editar'))

            <a href="{{ route('proyectos.edit', $proyecto->id) }}"
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
                    Código
                </span>

                <span class="min-w-0 break-words text-sm text-gray-600">
                    {{ $proyecto->codigo }}
                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Programa
                </span>

                <span class="min-w-0 break-words text-sm text-gray-600">

                    {{ $proyecto->programa?->codigo ?? 'No registra' }}

                    @if($proyecto->programa?->nombre)
                        - {{ $proyecto->programa->nombre }}
                    @endif

                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Responsable
                </span>

                <span class="min-w-0 break-words text-sm text-gray-600">

                    {{ trim(
                        ($proyecto->responsable?->nombres ?? '') . ' ' .
                        ($proyecto->responsable?->apellidos ?? '')
                    ) ?: 'No registra' }}

                    @if($proyecto->responsable?->cargo)
                        - {{ $proyecto->responsable->cargo }}
                    @endif

                </span>

            </div>

        </div>


        <!-- Columna derecha -->
        <div class="space-y-4">

            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Fecha de inicio
                </span>

                <span class="text-sm text-gray-600">
                    {{ $proyecto->fecha_inicio?->format('d/m/Y') ?? 'No registra' }}
                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Fecha de finalización
                </span>

                <span class="text-sm text-gray-600">
                    {{ $proyecto->fecha_fin?->format('d/m/Y') ?? 'No registra' }}
                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Presupuesto aprobado
                </span>

                <span class="text-sm text-gray-600">
                    USD {{ number_format((float) $proyecto->presupuesto_aprobado, 2) }}
                </span>

            </div>

        </div>


        <!-- Descripción -->
        <div class="md:col-span-2 flex">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Descripción
            </span>

            <span class="min-w-0 whitespace-pre-line break-words text-sm text-gray-600">{{ $proyecto->descripcion ?: 'No registra' }}</span>

        </div>

    </div>

</div>