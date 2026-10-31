@if(puedeHacer('usuarios', 'editarPassword'))

    @php
        $recuperarPassword =
            (string) old('_usuario_password_form', '') === (string) $usuario->id;
    @endphp

    <!-- Panel de contraseña -->
    <dialog
        id="panelPasswordUsuario"
        aria-labelledby="tituloPanelPasswordUsuario"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioPasswordUsuario"
            method="POST"
            action="{{ route('usuarios.actualizarpassword', $usuario->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input type="hidden"
                   name="_usuario_password_form"
                   value="{{ $usuario->id }}">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4
                        border-b border-gray-200 px-6 py-4">

                <div class="min-w-0">

                    <h2 id="tituloPanelPasswordUsuario"
                        class="text-xl font-semibold text-gray-800">
                        Restablecer contraseña
                    </h2>

                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $usuario->nombres }} {{ $usuario->apellidos }}
                    </p>

                </div>

                <button type="button"
                        data-cerrar-panel-password-usuario
                        aria-label="Cerrar panel"
                        class="shrink-0 p-2 text-gray-500
                               hover:bg-gray-100 hover:text-gray-800">

                    <i class="bi bi-x-lg" aria-hidden="true"></i>

                </button>

            </div>


            <!-- Contenido -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                @if($recuperarPassword && $errors->any())

                    <div role="alert"
                         class="mb-5 rounded-md bg-red-50 px-4 py-3
                                text-sm text-red-800">

                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                    </div>

                @endif

                <p class="mb-6 break-words text-sm text-gray-500">
                    Defina una nueva contraseña para {{ $usuario->email }}.
                </p>

                <div class="space-y-5">

                    <div>

                        <label for="passwordPanelUsuario"
                               class="block text-sm font-medium text-gray-700">
                            Nueva contraseña
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="password"
                            id="passwordPanelUsuario"
                            name="password"
                            autocomplete="new-password"
                            minlength="8"
                            required
                            class="mt-1 w-full rounded-md border border-gray-300
                                   px-3 py-2 text-sm text-gray-700
                                   focus:border-blue-500 focus:ring-blue-500">

                        <p class="mt-1 text-xs text-gray-500">
                            Mínimo 8 caracteres.
                        </p>

                    </div>

                    <div>

                        <label for="confirmacionPanelUsuario"
                               class="block text-sm font-medium text-gray-700">
                            Confirmar contraseña
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="password"
                            id="confirmacionPanelUsuario"
                            name="password_confirmation"
                            autocomplete="new-password"
                            minlength="8"
                            required
                            class="mt-1 w-full rounded-md border border-gray-300
                                   px-3 py-2 text-sm text-gray-700
                                   focus:border-blue-500 focus:ring-blue-500">

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
                        data-cerrar-panel-password-usuario
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