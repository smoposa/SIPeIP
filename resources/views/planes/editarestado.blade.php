@if(puedeHacer('planes', 'estado'))

    @php
        $recuperarEstado =
            (string) old('_plan_estado_form', '') === (string) $plan->id;

        $planHabilitado = $recuperarEstado
            ? (string) old('estado', '0') === '1'
            : $plan->estado === 'Activo';
    @endphp


    <!-- Panel de estado -->
    <dialog
        id="panelEstadoPlan"
        aria-labelledby="tituloPanelEstadoPlan"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioEstadoPlan"
            method="POST"
            action="{{ route('planes.actualizarestado', $plan->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input type="hidden"
                   name="_plan_estado_form"
                   value="{{ $plan->id }}">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4
                        border-b border-gray-200 px-6 py-4">

                <div class="min-w-0">

                    <h2 id="tituloPanelEstadoPlan"
                        class="text-xl font-semibold text-gray-800">
                        Editar estado administrativo
                    </h2>

                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $plan->nombre }}
                    </p>

                </div>

                <button type="button"
                        data-cerrar-panel-estado-plan
                        aria-label="Cerrar panel"
                        class="shrink-0 p-2 text-gray-500
                               hover:bg-gray-100 hover:text-gray-800">

                    <i class="bi bi-x-lg" aria-hidden="true"></i>

                </button>

            </div>


            <!-- Contenido -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                @if($recuperarEstado && $errors->any())

                    <div role="alert"
                         class="mb-5 rounded-md bg-red-50 px-4 py-3
                                text-sm text-red-800">

                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                    </div>

                @endif


                <div class="mb-6 space-y-3 rounded-md bg-gray-50 p-4">

                    <div>

                        <p class="text-xs font-semibold text-gray-700">
                            Estado del proceso
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $plan->estado_proceso }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs font-semibold text-gray-700">
                            Versión
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            v{{ $plan->version }}
                        </p>

                    </div>

                </div>


                <!-- Estado administrativo -->
                <input type="hidden"
                       name="estado"
                       value="0">

                <label for="estadoPanelPlan"
                       class="inline-flex items-center gap-3
                              text-sm font-medium text-gray-700">

                    <input
                        type="checkbox"
                        id="estadoPanelPlan"
                        name="estado"
                        value="1"
                        @checked($planHabilitado)
                        class="w-5 h-5">

                    Plan habilitado

                </label>

                <p class="mt-3 text-xs text-gray-500">
                    Este cambio afecta únicamente la disponibilidad
                    administrativa del plan.
                </p>

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
                        data-cerrar-panel-estado-plan
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