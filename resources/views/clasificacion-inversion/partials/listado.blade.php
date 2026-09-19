<div
    class="overflow-y-auto pr-1"
    style="height: calc(100vh - 390px); min-height: 300px;"
>

    @forelse($macrosectores as $macrosector)

        @include(
            'clasificacion-inversion.partials.macrosector',
            ['macrosector' => $macrosector]
        )

    @empty

        <div class="rounded-lg border border-dashed border-gray-300
                    bg-white px-6 py-12 text-center">

            <i class="bi bi-inbox text-3xl text-gray-300"></i>

            <p class="mt-3 text-sm font-medium text-gray-600">
                No existen clasificaciones registradas.
            </p>

            <p class="mt-1 text-xs text-gray-400">
                Registre un macrosector para comenzar.
            </p>

        </div>

    @endforelse

</div>