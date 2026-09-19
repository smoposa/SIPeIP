@php
    $totalSubsectoresMacrosector = $macrosector->sectores->sum(
        fn ($sector) => $sector->subsectores->count()
    );
@endphp

<details class="mb-3 overflow-hidden rounded-lg
                border border-gray-200 bg-white">

    <summary class="flex cursor-pointer list-none items-center
                    justify-between bg-gray-50 px-4 py-3
                    transition hover:bg-gray-100">

        <div class="flex min-w-0 items-center gap-3">

            <div class="flex h-9 w-9 flex-shrink-0 items-center
                        justify-center rounded-lg border
                        border-gray-200 bg-white">

                <i class="bi bi-grid-1x2 text-gray-600"></i>

            </div>

            <div class="min-w-0">

                <div class="flex flex-wrap items-center gap-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        {{ $macrosector->nombre }}
                    </h4>

                    @if($macrosector->estado === 'Activo')

                        <span class="inline-flex items-center rounded-full
                                     bg-green-50 px-2 py-0.5 text-[11px]
                                     font-medium text-green-700">
                            Activo
                        </span>

                    @else

                        <span class="inline-flex items-center rounded-full
                                     bg-red-50 px-2 py-0.5 text-[11px]
                                     font-medium text-red-700">
                            Inactivo
                        </span>

                    @endif

                </div>

                <p class="mt-0.5 text-xs text-gray-500">
                    {{ $macrosector->sectores->count() }}
                    sectores ·
                    {{ $totalSubsectoresMacrosector }}
                    subsectores
                </p>

            </div>

        </div>

        <i class="bi bi-chevron-down ml-4 text-sm text-gray-500"></i>

    </summary>

    <div class="space-y-3 border-t border-gray-200 p-3">

        @if(
            puedeHacer('clasificacion_inversion', 'editar')
            || puedeHacer('clasificacion_inversion', 'estado')
        )

            <div class="flex flex-wrap items-center justify-end gap-2">

                @if(puedeHacer('clasificacion_inversion', 'editar'))

                    <a
                        href="{{ route(
                            'clasificacion-inversion.macrosectores.edit',
                            $macrosector->id
                        ) }}"
                        class="inline-flex items-center gap-2 rounded-md
                               border border-gray-300 bg-white px-3 py-1.5
                               text-xs font-medium text-gray-700
                               transition hover:bg-gray-50"
                    >
                        <i class="bi bi-pencil"></i>

                        Editar macrosector
                    </a>

                @endif

                @if(puedeHacer('clasificacion_inversion', 'estado'))

                    <form
                        method="POST"
                        action="{{ route(
                            'clasificacion-inversion.macrosectores.estado',
                            $macrosector->id
                        ) }}"
                    >
                        @csrf
                        @method('PUT')

                        <input
                            type="hidden"
                            name="estado"
                            value="{{ $macrosector->estado === 'Activo' ? 0 : 1 }}"
                        >

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-md
                                   border px-3 py-1.5 text-xs font-medium
                                   transition
                                   {{ $macrosector->estado === 'Activo'
                                       ? 'border-red-200 bg-red-50 text-red-700 hover:bg-red-100'
                                       : 'border-green-200 bg-green-50 text-green-700 hover:bg-green-100' }}"
                        >
                            <i class="bi {{
                                $macrosector->estado === 'Activo'
                                    ? 'bi-toggle-off'
                                    : 'bi-toggle-on'
                            }}"></i>

                            {{ $macrosector->estado === 'Activo'
                                ? 'Inactivar'
                                : 'Activar' }}
                        </button>

                    </form>

                @endif

            </div>

        @endif

        @forelse($macrosector->sectores as $sector)

            @include(
                'clasificacion-inversion.partials.sector',
                ['sector' => $sector]
            )

        @empty

            <div class="rounded-md border border-dashed
                        border-gray-300 px-4 py-6 text-center">

                <p class="text-sm text-gray-500">
                    Este macrosector no tiene sectores registrados.
                </p>

            </div>

        @endforelse

    </div>

</details>