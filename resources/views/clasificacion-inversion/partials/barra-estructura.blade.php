<div class="flex flex-col gap-3 sm:flex-row
            sm:items-center sm:justify-between">

    <div>

        <h3 class="text-base font-semibold text-gray-800">
            Estructura de intervención
        </h3>

        <p class="mt-0.5 text-xs text-gray-500">
            Macrosector, sector y subsector con su código oficial.
        </p>

    </div>

    @if(puedeHacer('clasificacion_inversion', 'crear'))

        <a
            href="{{ route(
                'clasificacion-inversion.macrosectores.create'
            ) }}"
            class="inline-flex items-center justify-center gap-2
                   rounded-md bg-blue-600 px-4 py-2 text-sm
                   font-medium text-white transition hover:bg-blue-700"
        >
            <i class="bi bi-plus-lg"></i>

            Nuevo macrosector
        </a>

    @endif

</div>