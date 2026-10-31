<!-- Estado y trazabilidad -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado y trazabilidad
        </h4>

    </div>

</div>


<!-- Datos de estado y auditoría -->
<div class="px-4 py-5">

    <dl class="min-w-0 space-y-5">

        <!-- Estado -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado
            </dt>

            <dd class="min-w-0 flex-1">

                <span class="inline-flex rounded-md px-3 py-1 text-sm font-semibold {{
                    $avance->estado === 'Cerrado'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-gray-100 text-gray-700'
                }}">

                    {{ $avance->estado }}

                </span>

            </dd>

        </div>


        <!-- Registrado por -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Registrado por
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">

                {{ trim(
                    ($avance->creador?->nombres ?? '') . ' ' .
                    ($avance->creador?->apellidos ?? '')
                ) ?: 'No registra' }}

            </dd>

        </div>


        <!-- Fecha de registro -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Fecha de registro
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $avance->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </dd>

        </div>

    </dl>

</div>