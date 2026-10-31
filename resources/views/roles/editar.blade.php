@if(puedeHacer('roles', 'editar'))

    @php
        $recuperarInformacion =
            (string) old('_rol_form', '') === (string) $rol->id;
    @endphp


    <!-- Panel lateral de información -->
    <dialog
        id="panelEditarRol"
        aria-labelledby="tituloPanelEditarRol"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioEditarRol"
            method="POST"
            action="{{ route('roles.update', $rol->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="_rol_form"
                value="{{ $rol->id }}">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4
                        border-b border-gray-200 px-6 py-4">

                <div class="min-w-0">

                    <h2 id="tituloPanelEditarRol"
                        class="text-xl font-semibold text-gray-800">

                        Editar información

                    </h2>

                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $rol->nombre }}
                    </p>

                </div>


                <!-- Cerrar panel -->
                <button
                    type="button"
                    data-cerrar-panel-rol
                    aria-label="Cerrar panel"
                    class="shrink-0 p-2 text-gray-500
                           hover:bg-gray-100 hover:text-gray-800">

                    <i class="bi bi-x-lg" aria-hidden="true"></i>

                </button>

            </div>


            <!-- Campos -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                <!-- Errores de validación -->
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

                        <label for="nombrePanelRol"
                               class="block text-sm font-medium text-gray-700">

                            Nombre del rol <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="text"
                            id="nombrePanelRol"
                            name="nombre"
                            maxlength="100"
                            required
                            value="{{ $recuperarInformacion
                                ? old('nombre')
                                : $rol->nombre }}"
                            class="mt-1 w-full rounded-md border border-gray-300
                                   px-3 py-2 text-sm text-gray-700
                                   focus:border-blue-500 focus:ring-blue-500">

                    </div>


                    <!-- Descripción -->
                    <div>

                        <label for="descripcionPanelRol"
                               class="block text-sm font-medium text-gray-700">

                            Descripción <span class="text-red-500">*</span>

                        </label>

                        <textarea
                            id="descripcionPanelRol"
                            name="descripcion"
                            rows="6"
                            maxlength="255"
                            required
                            class="mt-1 w-full rounded-md border border-gray-300
                                   px-3 py-2 text-sm text-gray-700
                                   focus:border-blue-500 focus:ring-blue-500">{{ $recuperarInformacion ? old('descripcion') : $rol->descripcion }}</textarea>

                    </div>

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
                    data-cerrar-panel-rol
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
        #panelEditarRol::backdrop {
            background: rgb(0 0 0 / 20%);
        }
    </style>

@endif