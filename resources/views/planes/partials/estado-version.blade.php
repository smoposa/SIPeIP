<!-- Información administrativa -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información administrativa
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        <!-- Estado administrativo -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado administrativo
            </span>

            @if(($plan->estado ?? 'Activo') === 'Activo')

                <span class="inline-flex rounded-full bg-green-100 px-3 py-1
                             text-xs font-medium text-green-700">
                    Activo
                </span>

            @else

                <span class="inline-flex rounded-full bg-red-100 px-3 py-1
                             text-xs font-medium text-red-700">
                    Inactivo
                </span>

            @endif

        </div>

        <!-- Estado del proceso -->
        <div class="{{ isset($plan) ? 'mb-5' : '' }} flex min-w-0 items-center gap-4">

            <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado del proceso
            </span>

            @php
                $estadoProceso = $plan->estado_proceso ?? 'Borrador';
            @endphp

            @switch($estadoProceso)

                @case('Borrador')

                    <span class="inline-flex rounded-full bg-gray-100 px-3 py-1
                                 text-xs font-medium text-gray-700">
                        Borrador
                    </span>

                    @break

                @case('En revisión')

                    <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1
                                 text-xs font-medium text-yellow-700">
                        En revisión
                    </span>

                    @break

                @case('Observado')

                    <span class="inline-flex rounded-full bg-orange-100 px-3 py-1
                                 text-xs font-medium text-orange-700">
                        Observado
                    </span>

                    @break

                @case('Aprobado')

                    <span class="inline-flex rounded-full bg-blue-100 px-3 py-1
                                 text-xs font-medium text-blue-700">
                        Aprobado
                    </span>

                    @break

                @default

                    <span class="inline-flex rounded-full bg-gray-100 px-3 py-1
                                 text-xs font-medium text-gray-600">
                        Sin estado
                    </span>

            @endswitch

        </div>

        <!-- Versión: solamente durante la edición -->
        @isset($plan)

            <div class="flex min-w-0 items-center gap-4">

                <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                    Versión
                </span>

                <span class="inline-flex rounded-md bg-gray-100 px-3 py-1
                             text-sm font-medium text-gray-700">

                    v{{ $plan->version }}

                </span>

            </div>

        @endisset

    </div>

</div>