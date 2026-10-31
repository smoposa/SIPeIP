<!-- Estado y versión del plan -->
<div class="border-b border-gray-200 bg-gray-100">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado y versión del plan
        </h4>

    </div>

</div>


<!-- Información administrativa -->
<div class="mb-4 px-4 py-5">

    <div class="space-y-4">

        <!-- Estado administrativo -->
        <div class="flex min-w-0 items-center gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado administrativo
            </span>

            <div class="flex min-w-0 flex-1 flex-wrap items-center gap-4">

                <span class="inline-flex rounded-full px-3 py-1
                             text-xs font-medium {{
                                 $plan->estado === 'Activo'
                                     ? 'bg-green-100 text-green-700'
                                     : 'bg-red-100 text-red-700'
                             }}">

                    {{ $plan->estado }}

                </span>


                @if(puedeHacer('planes', 'estado'))

                    <a href="{{ route('planes.editarestado', $plan->id) }}"
                       data-editar-estado-plan
                       class="text-sm font-medium text-blue-600
                              hover:text-blue-800 hover:underline">

                        Editar

                    </a>

                @endif

            </div>

        </div>


        <!-- Estado del proceso -->
        <div class="flex min-w-0 items-center gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado del proceso
            </span>

            <div class="min-w-0 flex-1">

                @php
                    $claseProceso = match ($plan->estado_proceso) {
                        'Borrador' => 'bg-gray-100 text-gray-700',
                        'En revisión' => 'bg-yellow-100 text-yellow-700',
                        'Observado' => 'bg-orange-100 text-orange-700',
                        'Aprobado' => 'bg-blue-100 text-blue-700',
                        default => 'bg-gray-100 text-gray-600',
                    };
                @endphp

                <span class="inline-flex rounded-full px-3 py-1
                             text-xs font-medium {{ $claseProceso }}">

                    {{ $plan->estado_proceso ?: 'Sin estado' }}

                </span>

            </div>

        </div>


        <!-- Versión -->
        <div class="flex min-w-0 items-center gap-4">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Versión
            </span>

            <div class="min-w-0 flex-1">

                <span class="inline-flex rounded-md bg-gray-100 px-3 py-1
                             text-sm font-medium text-gray-700">

                    v{{ $plan->version }}

                </span>

            </div>

        </div>

    </div>

</div>