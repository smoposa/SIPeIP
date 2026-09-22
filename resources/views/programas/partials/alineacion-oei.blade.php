<!-- Alineación con objetivos estratégicos -->
<div class="mt-4 border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Alineación con Objetivos Estratégicos Institucionales
        </h4>

        <span class="rounded-full bg-blue-100 px-3 py-1
                     text-xs font-semibold text-blue-700">

            {{ $programa->objetivos->count() }}
            OEI

        </span>

    </div>

</div>

<div class="px-4 py-5">

    @forelse($programa->objetivos as $objetivo)

        <div class="mb-3 rounded-md border border-gray-200
                    bg-gray-50 px-4 py-3 last:mb-0">

            <!-- Código -->
            <p class="font-mono text-xs font-semibold text-[#024687]">
                {{ $objetivo->codigo ?? 'Sin código' }}
            </p>

            <!-- Nombre -->
            <p class="mt-1 break-words text-sm font-medium text-gray-800">
                {{ $objetivo->nombre ?? 'No registra' }}
            </p>

            <!-- Descripción -->
            @if($objetivo->descripcion)

                <p class="mt-2 break-words text-xs leading-relaxed text-gray-600">
                    {{ $objetivo->descripcion }}
                </p>

            @endif

            <!-- Información complementaria -->
            <div class="mt-2 space-y-1 text-xs text-gray-500">

                <!-- Plan institucional -->
                <p class="break-words">

                    <span class="font-semibold text-gray-600">
                        Plan:
                    </span>

                    @if($objetivo->plan)

                        {{ $objetivo->plan->codigo }}
                        -
                        {{ $objetivo->plan->nombre }}

                    @else

                        No registra

                    @endif

                </p>

                <!-- Registrado por -->
                <p class="break-words">

                    <span class="font-semibold text-gray-600">
                        Registrado por:
                    </span>

                    {{ $objetivo->usuario?->name ?? 'No registra' }}

                </p>

            </div>

        </div>

    @empty

        <div class="rounded-lg border border-dashed border-gray-300
                    bg-gray-50 px-6 py-8 text-center">

            <div class="mx-auto flex h-12 w-12 items-center
                        justify-center rounded-full bg-blue-100
                        text-xl text-blue-600">

                <i class="bi bi-bullseye"></i>

            </div>

            <p class="mt-3 text-sm font-semibold text-gray-700">
                No existen objetivos estratégicos institucionales asociados.
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Edite el programa para establecer su alineación institucional.
            </p>

        </div>

    @endforelse

</div>