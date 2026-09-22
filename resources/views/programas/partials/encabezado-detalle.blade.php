<!-- Encabezado del programa -->
<div class="flex items-center justify-between gap-4 pb-6">

    <!-- Información principal -->
    <div class="flex min-w-0 items-center gap-4">

        <!-- Ícono -->
        <div class="flex h-16 w-16 flex-shrink-0 items-center
                    justify-center rounded-full bg-[#0F766E]
                    text-3xl text-white">

            <i class="bi bi-briefcase"></i>

        </div>

        <!-- Nombre y código -->
        <div class="min-w-0">

            <h2 class="break-words text-xl font-semibold text-gray-800">
                {{ $programa->nombre }}
            </h2>

            <p class="mt-1 break-words text-sm text-gray-500">

                {{ $programa->codigo }}

                <span class="mx-1">
                    ·
                </span>

                Período
                {{ $programa->periodo_inicio }}
                -
                {{ $programa->periodo_fin }}

            </p>

        </div>

    </div>

    <!-- Estado del proceso -->
    <div class="flex-shrink-0 text-right">

        <p class="text-xs text-gray-500">
            Estado del proceso
        </p>

        @switch($programa->estado_proceso)

            @case('Borrador')

                <span class="mt-1 inline-flex rounded-full bg-gray-100
                             px-3 py-1 text-xs font-medium text-gray-700">
                    Borrador
                </span>

                @break

            @case('En revisión')

                <span class="mt-1 inline-flex rounded-full bg-yellow-100
                             px-3 py-1 text-xs font-medium text-yellow-700">
                    En revisión
                </span>

                @break

            @case('Observado')

                <span class="mt-1 inline-flex rounded-full bg-orange-100
                             px-3 py-1 text-xs font-medium text-orange-700">
                    Observado
                </span>

                @break

            @case('Aprobado')

                <span class="mt-1 inline-flex rounded-full bg-blue-100
                             px-3 py-1 text-xs font-medium text-blue-700">
                    Aprobado
                </span>

                @break

            @default

                <span class="mt-1 inline-flex rounded-full bg-gray-100
                             px-3 py-1 text-xs font-medium text-gray-600">
                    Sin estado
                </span>

        @endswitch

    </div>

</div>