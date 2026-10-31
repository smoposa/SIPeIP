<!-- Resultados y observaciones -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Resultados y observaciones
        </h4>

        @if($avance->estado === 'Borrador' && puedeHacer('avances', 'editar'))

            <a href="{{ route('avances.edit', $avance) }}"
               class="text-sm text-blue-600 hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>


<!-- Datos de resultados -->
<div class="px-4 py-5">

    <dl class="min-w-0 space-y-5">

        <!-- Resultado alcanzado -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Resultado alcanzado
            </dt>

            <dd class="min-w-0 flex-1 whitespace-pre-line break-words text-sm leading-relaxed text-gray-600">{{ $avance->resultado ?: 'No registra.' }}</dd>

        </div>


        <!-- Observaciones -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Observaciones
            </dt>

            <dd class="min-w-0 flex-1 whitespace-pre-line break-words text-sm leading-relaxed text-gray-600">{{ $avance->observaciones ?: 'No registra.' }}</dd>

        </div>

    </dl>

</div>