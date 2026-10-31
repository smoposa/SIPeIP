@if(puedeHacer('entidades', 'estado'))

    @php
        $recuperarEstado =
            (string) old('_entidad_estado_form', '') === (string) $entidad->id;

        $entidadHabilitada = $recuperarEstado
            ? (string) old('estado', '0') === '1'
            : $entidad->estado === 'Activo';
    @endphp


    <!-- Panel lateral de estado -->
    <dialog
        id="panelEstadoEntidad"
        aria-labelledby="tituloPanelEstadoEntidad"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioEstadoEntidad"
            method="POST"
            action="{{ route('entidades.actualizarestado', $entidad->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="_entidad_estado_form"
                value="{{ $entidad->id }}">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4
                        border-b border-gray-200 px-6 py-4">

                <div class="min-w-0">

                    <h2 id="tituloPanelEstadoEntidad"
                        class="text-xl font-semibold text-gray-800">

                        Editar estado

                    </h2>

                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $entidad->nombre }}
                    </p>

                </div>


                <!-- Cerrar panel -->
                <button
                    type="button"
                    data-cerrar-panel-estado-entidad
                    aria-label="Cerrar panel"
                    class="shrink-0 p-2 text-gray-500
                           hover:bg-gray-100 hover:text-gray-800">

                    <i class="bi bi-x-lg" aria-hidden="true"></i>

                </button>

            </div>


            <!-- Contenido -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                <!-- Errores de validación -->
                @if($recuperarEstado && $errors->any())

                    <div role="alert"
                         class="mb-5 rounded-md bg-red-50 px-4 py-3
                                text-sm text-red-800">

                        @foreach($errors->all() as $error)

                            <p>{{ $error }}</p>

                        @endforeach

                    </div>

                @endif


                <p class="mb-6 text-sm text-gray-500">
                    Habilite o deshabilite la entidad dentro del sistema.
                </p>


                <!-- Estado -->
                <div>

                    <input
                        type="hidden"
                        name="estado"
                        value="0">

                    <label for="estadoPanelEntidad"
                           class="inline-flex items-center gap-3
                                  text-sm font-medium text-gray-700">

                        <input
                            type="checkbox"
                            id="estadoPanelEntidad"
                            name="estado"
                            value="1"
                            @checked($entidadHabilitada)
                            class="w-5 h-5">

                        Entidad habilitada

                    </label>

                </div>

            </div>


            <!-- Acciones -->
            <div class="flex shrink-0 flex-wrap justify-end gap-3
                        border-t border-gray-200 bg-white px-6 py-4">

                <!-- Guardar -->
                <button
                    type="submit"
                    class="inline-flex h-10 items-center justify-center gap-2
                           rounded-md bg-[#024687] px-5 text-sm
                           font-medium text-white transition hover:bg-[#01325f]
                           focus:outline-none focus:ring-2 focus:ring-blue-600
                           focus:ring-offset-2">

                    <i class="bi bi-check-circle" aria-hidden="true"></i>
                    Guardar cambios

                </button>


                <!-- Cancelar -->
                <button
                    type="button"
                    data-cerrar-panel-estado-entidad
                    class="inline-flex h-10 items-center justify-center
                           rounded-md bg-gray-200 px-5 text-sm
                           font-medium text-gray-700 transition hover:bg-gray-300
                           focus:outline-none focus:ring-2 focus:ring-gray-400
                           focus:ring-offset-2">

                    Cancelar

                </button>

            </div>

        </form>

    </dialog>


    <style>
        #panelEstadoEntidad::backdrop {
            background: rgb(0 0 0 / 20%);
        }
    </style>

@endif