<!-- Información general -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información general
        </h4>

        @if(puedeHacer('programas', 'editar'))

            <a href="{{ route('programas.edit', $programa->id) }}"
               class="text-sm text-blue-600
                      hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>

<!-- Datos -->
<div class="px-4 py-5">

    <div class="min-w-0 space-y-5">

        <!-- Entidad -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre de la entidad
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $programa->entidad?->nombre ?? 'No registra' }}
            </span>

        </div>

        <!-- Código -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Código del programa
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $programa->codigo ?? 'No registra' }}
            </span>

        </div>

        <!-- Período -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Período de vigencia
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-600">

                @if($programa->periodo_inicio && $programa->periodo_fin)

                    {{ $programa->periodo_inicio }}
                    -
                    {{ $programa->periodo_fin }}

                @else

                    No registra

                @endif

            </span>

        </div>

        <!-- Responsable -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Responsable
            </span>

            <div class="min-w-0 flex-1">

                <p class="break-words text-sm text-gray-600">
                    {{ $programa->responsable?->name ?? 'No registra' }}
                </p>

                @if($programa->responsable?->rol?->nombre)

                    <p class="mt-1 text-xs text-gray-500">
                        {{ $programa->responsable->rol->nombre }}
                    </p>

                @endif

            </div>

        </div>

        <!-- Nombre -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre del programa
            </span>

            <span class="min-w-0 flex-1 break-words text-sm
                         font-medium text-[#0F766E]">
                {{ $programa->nombre ?? 'No registra' }}
            </span>

        </div>

        <!-- Descripción -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Descripción
            </span>

            <span class="min-w-0 flex-1 whitespace-pre-line break-words
                         text-sm leading-relaxed text-gray-600">{{ $programa->descripcion ?: 'No registra' }}</span>

        </div>

    </div>

</div>