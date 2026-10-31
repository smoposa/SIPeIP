@if(puedeHacer('usuarios', 'editarEntidad'))

    @php
        $recuperarEntidad =
            (string) old('_usuario_entidad_form', '') === (string) $usuario->id;

        $entidadSeleccionada = $recuperarEntidad
            ? old('entidad_id')
            : $usuario->entidad_id;
    @endphp

    <!-- Panel de entidad -->
    <dialog
        id="panelEntidadUsuario"
        aria-labelledby="tituloPanelEntidadUsuario"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioEntidadUsuario"
            method="POST"
            action="{{ route('usuarios.actualizarentidad', $usuario->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input type="hidden"
                   name="_usuario_entidad_form"
                   value="{{ $usuario->id }}">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4
                        border-b border-gray-200 px-6 py-4">

                <div class="min-w-0">

                    <h2 id="tituloPanelEntidadUsuario"
                        class="text-xl font-semibold text-gray-800">
                        Editar entidad
                    </h2>

                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $usuario->nombres }} {{ $usuario->apellidos }}
                    </p>

                </div>

                <button type="button"
                        data-cerrar-panel-entidad-usuario
                        aria-label="Cerrar panel"
                        class="shrink-0 p-2 text-gray-500
                               hover:bg-gray-100 hover:text-gray-800">

                    <i class="bi bi-x-lg" aria-hidden="true"></i>

                </button>

            </div>


            <!-- Contenido -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                @if($recuperarEntidad && $errors->any())

                    <div role="alert"
                         class="mb-5 rounded-md bg-red-50 px-4 py-3
                                text-sm text-red-800">

                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                    </div>

                @endif

                <div class="space-y-6">

                    <div>

                        <p class="text-sm font-medium text-gray-700">
                            Entidad actual
                        </p>

                        <p class="mt-1 break-words text-sm text-gray-600">
                            {{ $usuario->entidad?->nombre ?? 'No asignada' }}
                        </p>

                    </div>

                    <div>

                        <label for="entidadPanelUsuario"
                               class="block text-sm font-medium text-gray-700">
                            Cambiar entidad <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="entidadPanelUsuario"
                            name="entidad_id"
                            required
                            class="mt-1 w-full rounded-md border border-gray-300
                                   px-3 py-2 text-sm text-gray-700
                                   focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Seleccione una entidad</option>

                            @foreach($entidades as $entidad)

                                <option value="{{ $entidad->id }}"
                                    @selected(
                                        (string) $entidadSeleccionada
                                        === (string) $entidad->id
                                    )>

                                    {{ $entidad->nombre }}

                                </option>

                            @endforeach

                        </select>

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
                        data-cerrar-panel-entidad-usuario
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