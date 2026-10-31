<!-- Auditoría -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Auditoría
        </h4>

    </div>

</div>


<!-- Datos del registro -->
<div class="px-4 py-5">

    <dl class="space-y-4">

        <!-- Usuario creador -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Registrado por
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $plan->usuario?->name ?? 'No registra' }}
            </dd>

        </div>


        <!-- Fecha de creación -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Fecha de creación
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $plan->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </dd>

        </div>


        <!-- Última actualización -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Última actualización
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $plan->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </dd>

        </div>

    </dl>

</div>