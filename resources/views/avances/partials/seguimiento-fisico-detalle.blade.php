<!-- Seguimiento físico -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Seguimiento físico
        </h4>

        @if($avance->estado === 'Borrador' && puedeHacer('avances', 'editar'))

            <a href="{{ route('avances.edit', $avance) }}"
               class="text-sm text-blue-600 hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>


<!-- Valores del avance -->
<div class="px-4 py-5">

    <dl class="min-w-0 space-y-5">

        <!-- Valor programado -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Valor programado
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ number_format((float) $avance->valor_programado, 4) }}
            </dd>

        </div>


        <!-- Valor ejecutado -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Valor ejecutado
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ number_format((float) $avance->valor_ejecutado, 4) }}
            </dd>

        </div>


        <!-- Cumplimiento -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Cumplimiento
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm font-semibold {{
                $avance->alerta === 'Cumplido'
                    ? 'text-green-700'
                    : ($avance->alerta === 'En riesgo'
                        ? 'text-amber-700'
                        : 'text-red-700')
            }}">
                {{ number_format($avance->porcentaje_cumplimiento, 2) }}%
            </dd>

        </div>


        <!-- Alerta de cumplimiento -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Alerta de cumplimiento
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm {{
                $avance->alerta === 'Cumplido'
                    ? 'text-green-700'
                    : ($avance->alerta === 'En riesgo'
                        ? 'text-amber-700'
                        : 'text-red-700')
            }}">
                {{ $avance->alerta }}
            </dd>

        </div>

    </dl>

</div>