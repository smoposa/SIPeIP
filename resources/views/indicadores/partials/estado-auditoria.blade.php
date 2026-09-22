<!-- Estado del indicador -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado del indicador
        </h4>

    </div>

</div>

<div class="px-4 py-5">

    <div class="flex min-w-0 items-center gap-4">

        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
            Estado
        </span>

        <div class="flex min-w-0 flex-1 flex-wrap items-center gap-4">

            @if($indicador->estado === 'Activo')

                <span class="inline-flex rounded-full bg-green-100 px-3 py-1
                             text-xs font-medium text-green-700">
                    Activo
                </span>

            @else

                <span class="inline-flex rounded-full bg-red-100 px-3 py-1
                             text-xs font-medium text-red-700">
                    Inactivo
                </span>

            @endif

            @if(puedeHacer('indicadores', 'estado'))

                <a href="{{ route('indicadores.editarestado', $indicador->id) }}"
                   class="text-sm font-medium text-blue-600
                          hover:text-blue-800 hover:underline">
                    Editar
                </a>

            @endif

        </div>

    </div>

</div>

<!-- Auditoría -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Auditoría
        </h4>

    </div>

</div>

<div class="px-4 py-5">

    <div class="min-w-0 space-y-4">

        <!-- Registrado por -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Registrado por
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $indicador->usuario?->name ?? 'No registra' }}
            </span>

        </div>

        <!-- Fecha de creación -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Fecha de creación
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $indicador->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </span>

        </div>

        <!-- Última actualización -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Última actualización
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $indicador->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </span>

        </div>

    </div>

</div>