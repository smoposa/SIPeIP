@php
    $editando = isset($programa);

    $estadoAdministrativo = $editando
        ? $programa->estado
        : 'Activo';

    $estadoProceso = $editando
        ? $programa->estado_proceso
        : 'Borrador';
@endphp

<div class="mb-5 rounded-lg border border-gray-200 bg-white p-5">

    <div class="mb-4">

        <h3 class="text-base font-semibold text-gray-800">
            Estado del programa
        </h3>

        <p class="mt-0.5 text-xs text-gray-500">
            Los estados se administran mediante el flujo de inversión pública.
        </p>

    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

        {{-- Estado administrativo --}}
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">

            <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                Estado administrativo
            </p>

            <div class="mt-2">

                @if($estadoAdministrativo === 'Activo')

                    <span class="inline-flex items-center gap-1.5
                                 rounded-full bg-green-50 px-2.5 py-1
                                 text-xs font-medium text-green-700">

                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                        Activo

                    </span>

                @else

                    <span class="inline-flex items-center gap-1.5
                                 rounded-full bg-red-50 px-2.5 py-1
                                 text-xs font-medium text-red-700">

                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                        Inactivo

                    </span>

                @endif

            </div>

            <p class="mt-2 text-xs leading-relaxed text-gray-500">
                Indica si el programa está disponible para las operaciones
                institucionales.
            </p>

        </div>

        {{-- Estado del proceso --}}
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">

            <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                Estado del proceso
            </p>

            <div class="mt-2">

                @php
                    $claseEstadoProceso = match($estadoProceso) {
                        'Priorizado' =>
                            'bg-green-50 text-green-700',

                        'En revisión' =>
                            'bg-blue-50 text-blue-700',

                        'Observado' =>
                            'bg-amber-50 text-amber-700',

                        'Negado' =>
                            'bg-red-50 text-red-700',

                        default =>
                            'bg-gray-100 text-gray-700',
                    };
                @endphp

                <span class="inline-flex items-center rounded-full
                             px-2.5 py-1 text-xs font-medium
                             {{ $claseEstadoProceso }}">
                    {{ $estadoProceso }}
                </span>

            </div>

            <p class="mt-2 text-xs leading-relaxed text-gray-500">
                Representa la etapa de revisión y priorización del programa
                de inversión.
            </p>

        </div>

    </div>

    @if(!$editando)

        <div class="mt-4 rounded-md border border-blue-100
                    bg-blue-50 px-4 py-3">

            <p class="text-xs leading-relaxed text-blue-700">
                El programa se registrará como
                <strong>Activo</strong> y en estado
                <strong>Borrador</strong>. Los estados podrán modificarse
                posteriormente según los permisos y el flujo institucional.
            </p>

        </div>

    @endif

</div>