<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Alineación estratégica mediante el programa
        </h4>

    </div>

</div>


<!-- Alineación -->
<div class="px-4 py-4">

    <div class="space-y-4 mb-6">

        @forelse($proyecto->programa?->objetivos ?? [] as $objetivo)

            <div class="border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">

                <div class="flex">

                    <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Objetivo institucional
                    </span>

                    <span class="min-w-0 break-words text-sm text-gray-600">
                        {{ $objetivo->codigo }} - {{ $objetivo->nombre }}
                    </span>

                </div>


                @if($objetivo->plan)

                    <div class="flex mt-2">

                        <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Plan
                        </span>

                        <span class="min-w-0 break-words text-sm text-gray-600">
                            {{ $objetivo->plan->codigo }}
                            -
                            {{ $objetivo->plan->nombre }}
                        </span>

                    </div>

                @endif

            </div>

        @empty

            <p class="text-sm text-gray-500">
                El programa no tiene objetivos estratégicos asociados.
            </p>

        @endforelse

    </div>

</div>