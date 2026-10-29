@php
    $objetivosSeleccionados = array_map(
        'strval',
        (array) old(
            'objetivos',
            $programa->objetivos->pluck('id')->all()
        )
    );
@endphp


<div class="space-y-4">

    <!-- Código -->
    <div class="flex items-center">

        <label for="codigo_visual"
               class="w-48 flex-shrink-0 text-sm font-medium text-gray-700">
            Código institucional
        </label>

        <input
            type="text"
            id="codigo_visual"
            readonly
            value="{{ $programa->codigo }}"
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2
                   bg-gray-100 text-gray-600 cursor-not-allowed">

    </div>


    <!-- Entidad -->
    <div class="flex items-center">

        <span class="w-48 flex-shrink-0 text-sm font-medium text-gray-700">
            Entidad
        </span>

        <span class="w-2/3 text-sm text-gray-600">
            {{ $programa->entidad?->nombre ?? 'No registra' }}
        </span>

    </div>


    <!-- Nombre -->
    <div class="flex items-center">

        <label for="nombre"
               class="w-48 flex-shrink-0 text-sm font-medium text-gray-700">
            Nombre del programa <span class="text-red-500">*</span>
        </label>

        <div class="w-2/3">

            <input
                type="text"
                id="nombre"
                name="nombre"
                maxlength="255"
                required
                value="{{ old('nombre', $programa->nombre) }}"
                class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

            <x-input-error :messages="$errors->get('nombre')" class="mt-1" />

        </div>

    </div>


    <!-- Descripción -->
    <div class="flex items-start">

        <label for="descripcion"
               class="w-48 flex-shrink-0 pt-2 text-sm font-medium text-gray-700">
            Descripción
        </label>

        <div class="w-2/3">

            <textarea
                id="descripcion"
                name="descripcion"
                rows="4"
                maxlength="5000"
                class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">{{ old('descripcion', $programa->descripcion) }}</textarea>

            <x-input-error :messages="$errors->get('descripcion')" class="mt-1" />

        </div>

    </div>


    <!-- Responsable -->
    <div class="flex items-center">

        <label for="responsable_id"
               class="w-48 flex-shrink-0 text-sm font-medium text-gray-700">
            Responsable <span class="text-red-500">*</span>
        </label>

        <div class="w-2/3">

            <select
                id="responsable_id"
                name="responsable_id"
                required
                class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

                <option value="">Seleccione un responsable</option>

                @foreach($responsables as $responsable)

                    <option value="{{ $responsable->id }}"
                        @selected(
                            (string) old('responsable_id', $programa->responsable_id)
                            === (string) $responsable->id
                        )>

                        {{ $responsable->nombres }} {{ $responsable->apellidos }}

                        @if($responsable->cargo)
                            — {{ $responsable->cargo }}
                        @endif

                    </option>

                @endforeach

            </select>

            <x-input-error :messages="$errors->get('responsable_id')" class="mt-1" />

            @if($responsables->isEmpty())

                <p class="mt-1 text-xs text-amber-600">
                    La entidad no tiene usuarios activos disponibles
                    para asignar como responsables.
                </p>

            @endif

        </div>

    </div>


    <!-- Período inicial -->
    <div class="flex items-center">

        <label for="periodo_inicio"
               class="w-48 flex-shrink-0 text-sm font-medium text-gray-700">
            Período inicial <span class="text-red-500">*</span>
        </label>

        <div class="w-2/3">

            <input
                type="number"
                id="periodo_inicio"
                name="periodo_inicio"
                min="2000"
                max="2100"
                step="1"
                required
                value="{{ old('periodo_inicio', $programa->periodo_inicio) }}"
                class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

            <x-input-error :messages="$errors->get('periodo_inicio')" class="mt-1" />

        </div>

    </div>


    <!-- Período final -->
    <div class="flex items-center">

        <label for="periodo_fin"
               class="w-48 flex-shrink-0 text-sm font-medium text-gray-700">
            Período final <span class="text-red-500">*</span>
        </label>

        <div class="w-2/3">

            <input
                type="number"
                id="periodo_fin"
                name="periodo_fin"
                min="2000"
                max="2100"
                step="1"
                required
                value="{{ old('periodo_fin', $programa->periodo_fin) }}"
                class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

            <x-input-error :messages="$errors->get('periodo_fin')" class="mt-1" />

        </div>

    </div>


    <!-- Objetivos estratégicos -->
    <div class="flex items-start">

        <span id="etiquetaObjetivos"
              class="w-48 flex-shrink-0 pt-2 text-sm font-medium text-gray-700">
            Objetivos estratégicos <span class="text-red-500">*</span>
        </span>

        <div class="w-2/3">

            <p id="ayudaObjetivos" class="mb-2 text-xs text-gray-500">
                Seleccione uno o varios objetivos estratégicos institucionales.
            </p>

            <div role="group"
                 aria-labelledby="etiquetaObjetivos"
                 aria-describedby="ayudaObjetivos"
                 class="max-h-72 overflow-y-auto rounded-md border border-gray-300">

                @forelse($objetivos as $objetivo)

                    <label class="flex items-start gap-3 border-b border-gray-100
                                  p-3 last:border-b-0 hover:bg-gray-50 cursor-pointer">

                        <input
                            type="checkbox"
                            name="objetivos[]"
                            value="{{ $objetivo->id }}"
                            @checked(
                                in_array(
                                    (string) $objetivo->id,
                                    $objetivosSeleccionados,
                                    true
                                )
                            )
                            class="mt-1 rounded border-gray-300 text-blue-600
                                   focus:ring-blue-500">

                        <span class="min-w-0">

                            <span class="block text-sm text-gray-700">
                                {{ $objetivo->codigo }} — {{ $objetivo->nombre }}
                            </span>

                            @if($objetivo->plan)

                                <span class="mt-1 block text-xs text-gray-500">
                                    Plan: {{ $objetivo->plan->nombre }}
                                </span>

                            @endif

                        </span>

                    </label>

                @empty

                    <p class="p-4 text-sm text-gray-500">
                        La entidad no tiene objetivos estratégicos activos disponibles.
                    </p>

                @endforelse

            </div>

            <x-input-error :messages="$errors->get('objetivos')" class="mt-1" />

            @foreach($errors->get('objetivos.*') as $mensajes)

                <x-input-error :messages="$mensajes" class="mt-1" />

            @endforeach

        </div>

    </div>


    <!-- Estado administrativo -->
    <div class="flex items-center">

        <span class="w-48 flex-shrink-0 text-sm font-medium text-gray-700">
            Estado administrativo
        </span>

        <div class="w-2/3">

            @if($programa->estado === 'Activo')

                <span class="inline-flex rounded-full bg-green-100 px-2 py-1
                             text-xs text-green-700">
                    Activo
                </span>

            @else

                <span class="inline-flex rounded-full bg-red-100 px-2 py-1
                             text-xs text-red-700">
                    Inactivo
                </span>

            @endif

        </div>

    </div>


    <!-- Estado del proceso -->
    <div class="flex items-center">

        <span class="w-48 flex-shrink-0 text-sm font-medium text-gray-700">
            Estado del proceso
        </span>

        <span class="w-2/3 text-sm text-gray-600">
            {{ $programa->estado_proceso ?: 'Sin estado' }}
        </span>

    </div>

</div>