@if(puedeHacer('usuarios', 'estado'))

    @php
        $recuperarEstado =
            (string) old('_usuario_estado_form', '') === (string) $usuario->id;

        $usuarioHabilitado = $recuperarEstado
            ? old('estado', 'Inactivo') === 'Activo'
            : $usuario->estado === 'Activo';
    @endphp


    <!-- Panel lateral de estado -->
    <dialog
        id="panelEstadoUsuario"
        aria-labelledby="tituloPanelEstadoUsuario"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioEstadoUsuario"
            method="POST"
            action="{{ route('usuarios.actualizarestado', $usuario->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="_usuario_estado_form"
                value="{{ $usuario->id }}">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4
                        border-b border-gray-200 px-6 py-4">

                <div class="min-w-0">

                    <h2 id="tituloPanelEstadoUsuario"
                        class="text-xl font-semibold text-gray-800">

                        Editar estado

                    </h2>

                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $usuario->nombres }} {{ $usuario->apellidos }}
                    </p>

                </div>

                <button
                    type="button"
                    data-cerrar-panel-estado-usuario
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


                <!-- Error de la operación -->
                @if(session('error'))

                    <div role="alert"
                         class="mb-5 rounded-md bg-red-50 px-4 py-3
                                text-sm text-red-800">

                        {{ session('error') }}

                    </div>

                @endif


                <p class="mb-6 text-sm text-gray-500">
                    Habilite o deshabilite el usuario dentro del sistema.
                </p>


                <!-- Estado -->
                <input
                    type="hidden"
                    name="estado"
                    value="Inactivo">

                <label for="estadoPanelUsuario"
                       class="inline-flex items-center gap-3
                              text-sm font-medium text-gray-700">

                    <input
                        type="checkbox"
                        id="estadoPanelUsuario"
                        name="estado"
                        value="Activo"
                        @checked($usuarioHabilitado)
                        class="w-5 h-5">

                    Usuario habilitado

                </label>

            </div>


            <!-- Acciones -->
            <div class="flex shrink-0 flex-wrap justify-end gap-3
                        border-t border-gray-200 bg-white px-6 py-4">

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

                <button
                    type="button"
                    data-cerrar-panel-estado-usuario
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
        #panelEstadoUsuario::backdrop {
            background: rgb(0 0 0 / 20%);
        }
    </style>

@endif