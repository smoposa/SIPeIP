<!-- Cabecera del plan -->
<div class="flex flex-wrap items-start justify-between gap-4 pb-6">

    <div class="flex min-w-0 flex-1 items-start gap-4">

        <!-- Icono -->
        <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center
                    rounded-full bg-[#0F766E] text-3xl text-white">

            <i class="bi bi-file-earmark-text" aria-hidden="true"></i>

        </div>

        <!-- Identificación del plan -->
        <div class="min-w-0 flex-1">

            <h2 class="break-words text-xl font-semibold text-gray-800">
                {{ $plan->nombre }}
            </h2>

            <p class="mt-1 break-words text-sm text-gray-600">
                {{ $plan->entidad?->nombre ?? 'Entidad no registrada' }}
            </p>

            <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1
                        text-xs text-gray-500">

                <span class="break-words">
                    <span class="font-medium text-gray-600">
                        Código:
                    </span>

                    {{ $plan->codigo ?? 'No registra' }}
                </span>

                <span class="break-words">
                    <span class="font-medium text-gray-600">
                        Tipo:
                    </span>

                    {{ $plan->tipo ?: 'No registra' }}
                </span>

            </div>

        </div>

    </div>

    <!-- Versión -->
    <div class="ml-auto flex-shrink-0 text-right">

        <p class="text-xs text-gray-500">
            Versión
        </p>

        <span class="mt-1 inline-flex rounded-md bg-gray-100 px-3 py-1
                     text-sm font-semibold text-gray-700">

            v{{ $plan->version }}

        </span>

    </div>

</div>