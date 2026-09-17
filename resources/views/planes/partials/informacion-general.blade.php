<!-- Información institucional -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información institucional
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        <p class="mb-5 text-xs text-gray-500">
            Estos datos se asignan automáticamente al plan y no pueden modificarse.
        </p>

        <!-- Nombre de la entidad -->
        <div class="mb-4 flex min-w-0 items-start gap-4">

            <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre de la entidad
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                {{ auth()->user()->entidad?->nombre ?? 'No registra' }}
            </span>

        </div>

        <!-- Código del plan -->
        <div class="mb-4 flex min-w-0 items-start gap-4">

            <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                Código del plan
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                {{ $plan->codigo ?? $codigo ?? 'No registra' }}
            </span>

        </div>

        <!-- Tipo de plan -->
        <div class="flex min-w-0 items-start gap-4">

            <span class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                Tipo de plan
            </span>

            <span class="min-w-0 flex-1 break-words text-sm text-gray-800">
                {{ $plan->tipo ?? 'Plan Estratégico Institucional' }}
            </span>

        </div>

    </div>

</div>

<!-- Información del plan -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Información del plan
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        <!-- Nombre del plan -->
        <div class="mb-5 flex min-w-0 items-center gap-4">

            <label for="nombre"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Nombre del plan
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <input type="text"
                       id="nombre"
                       name="nombre"
                       maxlength="255"
                       value="{{ old('nombre', $plan->nombre ?? '') }}"
                       required
                       placeholder="Ingrese el nombre del plan"
                       class="h-10 w-full min-w-0 rounded-md border-gray-300
                              px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

            </div>

        </div>

        <!-- Período de vigencia -->
        <div class="mb-5 flex min-w-0 items-start gap-4">

            <span class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                Período de vigencia
                <span class="text-red-500">*</span>

            </span>

            <div class="grid min-w-0 flex-1 grid-cols-1 gap-3 sm:grid-cols-2">

                <!-- Año de inicio -->
                <div>

                    <label for="periodo_inicio"
                           class="mb-1 block text-xs font-medium text-gray-500">
                        Año de inicio
                    </label>

                    <input type="number"
                           id="periodo_inicio"
                           name="periodo_inicio"
                           min="2000"
                           max="2100"
                           value="{{ old('periodo_inicio', $plan->periodo_inicio ?? '') }}"
                           required
                           placeholder="2026"
                           class="h-10 w-full min-w-0 rounded-md border-gray-300
                                  px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                </div>

                <!-- Año de finalización -->
                <div>

                    <label for="periodo_fin"
                           class="mb-1 block text-xs font-medium text-gray-500">
                        Año de finalización
                    </label>

                    <input type="number"
                           id="periodo_fin"
                           name="periodo_fin"
                           min="2000"
                           max="2100"
                           value="{{ old('periodo_fin', $plan->periodo_fin ?? '') }}"
                           required
                           placeholder="2029"
                           class="h-10 w-full min-w-0 rounded-md border-gray-300
                                  px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                </div>

            </div>

        </div>

        <!-- Descripción -->
        <div class="flex min-w-0 items-start gap-4">

            <label for="descripcion"
                   class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">

                Descripción del plan
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <textarea id="descripcion"
                          name="descripcion"
                          rows="4"
                          maxlength="1000"
                          required
                          placeholder="Ingrese una descripción del plan"
                          class="w-full min-w-0 rounded-md border-gray-300
                                 px-3 py-2 text-sm focus:border-blue-500
                                 focus:ring-blue-500">{{ old('descripcion', $plan->descripcion ?? '') }}</textarea>

            </div>

        </div>

    </div>

</div>

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