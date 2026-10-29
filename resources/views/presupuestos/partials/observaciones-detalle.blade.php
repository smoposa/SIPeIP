<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Observaciones
        </h4>

    </div>

</div>


<!-- Observaciones -->
<div class="px-4 py-4">

    <div class="flex mb-6">

        <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
            Observaciones
        </span>

        <span class="min-w-0 whitespace-pre-line break-words text-sm text-gray-600">{{ $presupuesto->observaciones ?: 'No registra.' }}</span>

    </div>

</div>