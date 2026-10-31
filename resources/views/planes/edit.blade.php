@if(puedeHacer('planes', 'editar'))

    @php
        $recuperarInformacion =
            (string) old('_plan_form', '') === (string) $plan->id;
    @endphp


    <!-- Panel de información -->
    <dialog
        id="panelEditarPlan"
        aria-labelledby="tituloPanelEditarPlan"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioEditarPlan"
            method="POST"
            action="{{ route('planes.update', $plan->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input type="hidden"
                   name="_plan_form"
                   value="{{ $plan->id }}">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4
                        border-b border-gray-200 px-6 py-4">

                <div class="min-w-0">

                    <h2 id="tituloPanelEditarPlan"
                        class="text-xl font-semibold text-gray-800">
                        Editar plan institucional
                    </h2>

                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $plan->codigo }}
                    </p>

                </div>

                <button type="button"
                        data-cerrar-panel-plan
                        aria-label="Cerrar panel"
                        class="shrink-0 p-2 text-gray-500
                               hover:bg-gray-100 hover:text-gray-800">

                    <i class="bi bi-x-lg" aria-hidden="true"></i>

                </button>

            </div>


            <!-- Contenido -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                <!-- Errores -->
                @if($recuperarInformacion && $errors->any())

                    <div role="alert"
                         class="mb-5 rounded-md bg-red-50 px-4 py-3
                                text-sm text-red-800">

                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                    </div>

                @endif

                <p class="mb-5 text-xs text-gray-500">
                    Los campos con <span class="text-red-500">*</span>
                    son obligatorios.
                </p>


                <div class="space-y-5">

                    <!-- Nombre -->
                    <div>

                        <label for="nombrePanelPlan"
                               class="block text-sm font-medium text-gray-700">
                            Nombre del plan <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="nombrePanelPlan"
                            name="nombre"
                            maxlength="255"
                            required
                            value="{{ $recuperarInformacion
                                ? old('nombre')
                                : $plan->nombre }}"
                            class="mt-1 w-full rounded-md border border-gray-300
                                   px-3 py-2 text-sm text-gray-700
                                   focus:border-blue-500 focus:ring-blue-500">

                    </div>


                    <!-- Período -->
                    <div class="grid grid-cols-2 gap-4">

                        <div>

                            <label for="inicioPanelPlan"
                                   class="block text-sm font-medium text-gray-700">
                                Año de inicio
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                id="inicioPanelPlan"
                                name="periodo_inicio"
                                min="2000"
                                max="2100"
                                required
                                value="{{ $recuperarInformacion
                                    ? old('periodo_inicio')
                                    : $plan->periodo_inicio }}"
                                class="mt-1 w-full rounded-md border border-gray-300
                                       px-3 py-2 text-sm text-gray-700
                                       focus:border-blue-500 focus:ring-blue-500">

                        </div>

                        <div>

                            <label for="finPanelPlan"
                                   class="block text-sm font-medium text-gray-700">
                                Año de finalización
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                id="finPanelPlan"
                                name="periodo_fin"
                                min="2000"
                                max="2100"
                                required
                                value="{{ $recuperarInformacion
                                    ? old('periodo_fin')
                                    : $plan->periodo_fin }}"
                                class="mt-1 w-full rounded-md border border-gray-300
                                       px-3 py-2 text-sm text-gray-700
                                       focus:border-blue-500 focus:ring-blue-500">

                        </div>

                    </div>


                    <!-- Descripción -->
                    <div>

                        <label for="descripcionPanelPlan"
                               class="block text-sm font-medium text-gray-700">
                            Descripción <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="descripcionPanelPlan"
                            name="descripcion"
                            rows="6"
                            maxlength="1000"
                            required
                            class="mt-1 w-full rounded-md border border-gray-300
                                   px-3 py-2 text-sm text-gray-700
                                   focus:border-blue-500 focus:ring-blue-500">{{ $recuperarInformacion ? old('descripcion') : $plan->descripcion }}</textarea>

                    </div>

                </div>

            </div>


            <!-- Acciones -->
            <div class="flex shrink-0 flex-wrap justify-end gap-3
                        border-t border-gray-200 bg-white px-6 py-4">

                <button type="submit"
                        class="inline-flex h-10 items-center justify-center gap-2
                               rounded-md bg-[#024687] px-5 text-sm font-medium
                               text-white transition hover:bg-[#01325f]
                               focus:outline-none focus:ring-2 focus:ring-blue-600
                               focus:ring-offset-2">

                    <i class="bi bi-check-circle" aria-hidden="true"></i>
                    Guardar cambios

                </button>

                <button type="button"
                        data-cerrar-panel-plan
                        class="inline-flex h-10 items-center justify-center
                               rounded-md bg-gray-200 px-5 text-sm font-medium
                               text-gray-700 transition hover:bg-gray-300
                               focus:outline-none focus:ring-2 focus:ring-gray-400
                               focus:ring-offset-2">

                    Cancelar

                </button>

            </div>

        </form>

    </dialog>

@endif