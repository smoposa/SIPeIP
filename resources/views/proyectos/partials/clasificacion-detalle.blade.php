<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Clasificación de la intervención
        </h4>

    </div>

</div>


<!-- Clasificación -->
<div class="px-4 py-4">

    <div class="space-y-4 mb-6">

        <div class="flex">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Macrosector
            </span>

            <span class="min-w-0 break-words text-sm text-gray-600">
                {{ $proyecto->subsector?->sector?->macrosector?->nombre ?? 'No registra' }}
            </span>

        </div>


        <div class="flex">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Sector
            </span>

            <span class="min-w-0 break-words text-sm text-gray-600">
                {{ $proyecto->subsector?->sector?->nombre ?? 'No registra' }}
            </span>

        </div>


        <div class="flex">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Subsector
            </span>

            <span class="min-w-0 break-words text-sm text-gray-600">

                {{ $proyecto->subsector?->codigo ?? 'No registra' }}

                @if($proyecto->subsector?->nombre)
                    - {{ $proyecto->subsector->nombre }}
                @endif

            </span>

        </div>

    </div>

</div>