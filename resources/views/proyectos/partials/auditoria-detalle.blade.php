<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Auditoría
        </h4>

    </div>

</div>


<!-- Trazabilidad -->
<div class="px-4 py-4">

    <div class="space-y-4">

        <!-- Usuario creador -->
        <div class="flex">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Registrado por
            </span>

            <span class="min-w-0 break-words text-sm text-gray-600">

                {{ trim(
                    ($proyecto->usuario?->nombres ?? '') . ' ' .
                    ($proyecto->usuario?->apellidos ?? '')
                ) ?: 'No registra' }}

            </span>

        </div>


        <!-- Fecha de creación -->
        <div class="flex">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Fecha de creación
            </span>

            <span class="text-sm text-gray-600">
                {{ $proyecto->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </span>

        </div>


        <!-- Última actualización -->
        <div class="flex">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Última actualización
            </span>

            <span class="text-sm text-gray-600">
                {{ $proyecto->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </span>

        </div>

    </div>

</div>