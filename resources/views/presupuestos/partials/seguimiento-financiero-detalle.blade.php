<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Seguimiento financiero
        </h4>

    </div>

</div>


<!-- Montos -->
<div class="px-4 py-4">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 mb-6">

        <!-- Columna izquierda -->
        <div class="space-y-4">

            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Aprobado del proyecto
                </span>

                <span class="text-sm text-gray-600">

                    @if($presupuesto->proyecto)

                        USD {{ number_format(
                            (float) $presupuesto->proyecto->presupuesto_aprobado,
                            2
                        ) }}

                    @else

                        No registra

                    @endif

                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Monto programado
                </span>

                <span class="text-sm text-gray-600">
                    USD {{ number_format((float) $presupuesto->monto_programado, 2) }}
                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Presupuesto vigente
                </span>

                <span class="text-sm text-gray-600">
                    USD {{ number_format((float) $presupuesto->presupuesto_vigente, 2) }}
                </span>

            </div>

        </div>


        <!-- Columna derecha -->
        <div class="space-y-4">

            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Monto ejecutado
                </span>

                <span class="text-sm text-gray-600">
                    USD {{ number_format((float) $presupuesto->monto_ejecutado, 2) }}
                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Ejecución financiera
                </span>

                <span class="text-sm font-semibold {{
                    $presupuesto->alerta === 'Cumplido'
                        ? 'text-green-700'
                        : ($presupuesto->alerta === 'En riesgo'
                            ? 'text-amber-700'
                            : 'text-red-700')
                }}">
                    {{ number_format($presupuesto->porcentaje_ejecucion, 2) }}%
                </span>

            </div>


            <div class="flex">

                <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Alerta
                </span>

                <span class="text-sm text-gray-600">
                    {{ $presupuesto->alerta }}
                </span>

            </div>

        </div>

    </div>

</div>