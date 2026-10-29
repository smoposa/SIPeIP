@php
    $claseEjecucion = match($proyecto->estado) {
        'En ejecución' => 'bg-blue-100 text-blue-700',
        'Finalizado' => 'bg-green-100 text-green-700',
        'Suspendido' => 'bg-red-100 text-red-700',
        default => 'bg-gray-100 text-gray-700',
    };

    $claseProceso = match($proyecto->estado_proceso) {
        'Priorizado' => 'bg-green-100 text-green-700',
        'Observado' => 'bg-amber-100 text-amber-700',
        'Negado' => 'bg-red-100 text-red-700',
        'En revisión' => 'bg-blue-100 text-blue-700',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp


<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estados del proyecto
        </h4>

    </div>

</div>


<!-- Estados -->
<div class="px-4 py-4">

    <div class="space-y-4 mb-6">

        <!-- Ejecución -->
        <div class="flex items-start">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado de ejecución
            </span>

            <div class="min-w-0 flex-1">

                <span class="inline-flex rounded-full px-2 py-1 text-xs {{ $claseEjecucion }}">
                    {{ $proyecto->estado ?: 'Sin estado' }}
                </span>

                @if(puedeHacer('proyectos', 'editar'))

                    <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                       class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Editar
                    </a>

                @endif

            </div>

        </div>


        <!-- Administrativo -->
        <div class="flex items-start">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Estado administrativo
            </span>

            <div class="min-w-0 flex-1 flex flex-wrap items-center gap-x-10 gap-y-2">

                @if($proyecto->estado_administrativo === 'Activo')

                    <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs text-green-700">
                        Activo
                    </span>

                @else

                    <span class="inline-flex rounded-full bg-red-100 px-2 py-1 text-xs text-red-700">
                        Inactivo
                    </span>

                @endif


                @if(puedeHacer('proyectos', 'estado'))

                    <form method="POST"
                          action="{{ route('proyectos.estado', $proyecto->id) }}">

                        @csrf
                        @method('PUT')

                        <input type="hidden"
                               name="estado"
                               value="{{ $proyecto->estado_administrativo === 'Activo' ? 0 : 1 }}">

                        <button type="submit"
                                class="text-sm text-blue-600 hover:text-blue-800 hover:underline">

                            {{ $proyecto->estado_administrativo === 'Activo'
                                ? 'Inactivar proyecto'
                                : 'Activar proyecto' }}

                        </button>

                    </form>

                @endif

            </div>

        </div>


        <!-- Proceso -->
        <div class="flex items-start">

            <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Proceso de priorización
            </span>

            <div class="min-w-0 flex-1">

                <span class="inline-flex rounded-full px-2 py-1 text-xs {{ $claseProceso }}">
                    {{ $proyecto->estado_proceso ?: 'Sin estado' }}
                </span>


                @if(puedeHacer('proyectos', 'proceso'))

                    <form method="POST"
                          action="{{ route('proyectos.estado-proceso', $proyecto->id) }}"
                          class="mt-3">

                        @csrf
                        @method('PUT')

                        <div class="flex flex-wrap items-center gap-2">

                            <label for="estadoProcesoProyecto" class="sr-only">
                                Cambiar proceso de priorización
                            </label>

                            <select id="estadoProcesoProyecto"
                                    name="estado_proceso"
                                    class="max-w-full rounded-md border border-gray-300
                                           px-3 py-2 text-sm
                                           focus:border-blue-500 focus:ring-blue-500">

                                @foreach($estadosProceso as $estadoProceso)

                                    <option value="{{ $estadoProceso->value }}"
                                        @selected(
                                            old('estado_proceso', $proyecto->estado_proceso)
                                            === $estadoProceso->value
                                        )>

                                        {{ $estadoProceso->value }}

                                    </option>

                                @endforeach

                            </select>

                            <button type="submit"
                                    class="rounded-md bg-blue-600 px-4 py-2
                                           text-sm font-medium text-white
                                           transition hover:bg-blue-700">

                                Guardar

                            </button>

                        </div>

                        <x-input-error :messages="$errors->get('estado_proceso')" class="mt-1" />

                    </form>

                @endif

            </div>

        </div>

    </div>

</div>