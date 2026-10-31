<!-- Auditoría -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Auditoría
        </h4>

    </div>

</div>


<!-- Fechas del registro -->
<div class="px-4 py-5">

    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Fecha de creación -->
        <div>

            <dt class="text-sm font-semibold text-gray-700">
                Fecha de creación
            </dt>

            <dd class="mt-1 text-sm text-gray-600">
                {{ $entidad->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </dd>

        </div>


        <!-- Última actualización -->
        <div>

            <dt class="text-sm font-semibold text-gray-700">
                Última actualización
            </dt>

            <dd class="mt-1 text-sm text-gray-600">
                {{ $entidad->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </dd>

        </div>

    </dl>

</div>