@if(puedeHacer('usuarios', 'crear'))

    <!-- Panel lateral de creación de usuarios -->
    <dialog id="panelCrearUsuario" aria-labelledby="tituloPanelCrearUsuario"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 600px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioCrearUsuario"
            method="POST"
            action="{{ route('usuarios.store') }}"
            class="flex h-full flex-col">

            @csrf

            <input type="hidden" name="_crear_usuario_panel" value="1">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">
                <div class="min-w-0">
                    <h2 id="tituloPanelCrearUsuario"
                        class="text-xl font-semibold text-gray-800">

                        Crear usuario

                    </h2>
                    <p class="mt-1 break-words text-sm text-gray-500">
                        Registre un nuevo usuario dentro del sistema.
                    </p>
                </div>
                <button
                    type="button"
                    data-cerrar-panel-crear-usuario
                    aria-label="Cerrar panel"
                    class="shrink-0 p-2 text-gray-500
                           hover:bg-gray-100 hover:text-gray-800">
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </button>
            </div>


            <!-- Campos -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                @if(old('_crear_usuario_panel') === '1' && $errors->any())

                    <div role="alert" class="mb-5 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">

                        @foreach($errors->all() as $error)

                            <p>{{ $error }}</p>

                        @endforeach

                    </div>

                @endif

                <div class="space-y-4">

                    <!-- Identificación -->
                    <div>

                        <label for="crearUsuario_identificacion" class="block mb-1 text-sm font-medium text-gray-700">
                            Identificación <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="crearUsuario_identificacion"
                            type="text"
                            name="identificacion"
                            maxlength="20"
                            required
                            value="{{ old('identificacion') }}"
                            class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Nombres -->
                    <div>

                        <label for="crearUsuario_nombres" class="block mb-1 text-sm font-medium text-gray-700">
                            Nombres <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="crearUsuario_nombres"
                            type="text"
                            name="nombres"
                            maxlength="100"
                            required
                            value="{{ old('nombres') }}"
                            class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Apellidos -->
                    <div>

                        <label for="crearUsuario_apellidos" class="block mb-1 text-sm font-medium text-gray-700">
                            Apellidos <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="crearUsuario_apellidos"
                            type="text"
                            name="apellidos"
                            maxlength="100"
                            required
                            value="{{ old('apellidos') }}"
                            class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Correo Institucional -->
                    <div>

                        <label for="crearUsuario_email" class="block mb-1 text-sm font-medium text-gray-700">
                            Correo Institucional <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="crearUsuario_email"
                            type="email"
                            name="email"
                            maxlength="255"
                            required
                            value="{{ old('email') }}"
                            class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Cargo -->
                    <div>

                        <label for="crearUsuario_cargo" class="block mb-1 text-sm font-medium text-gray-700">
                            Cargo <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="crearUsuario_cargo"
                            type="text"
                            name="cargo"
                            maxlength="150"
                            required
                            value="{{ old('cargo') }}"
                            class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Rol -->
                    <div>
                        <label for="crearUsuarioRol" class="block mb-1 text-sm font-medium text-gray-700">
                            Rol <span class="text-red-500">*</span>
                        </label>
                        <select id="crearUsuarioRol" name="rol_id" required
                            class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">
                            <option value="">Seleccione</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}" @selected(old('rol_id') == $rol->id)>
                                    {{ $rol->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Entidad -->
                    <div>
                        <label for="crearUsuarioEntidad" class="block mb-1 text-sm font-medium text-gray-700">
                            Entidad <span class="text-red-500">*</span>
                        </label>
                        @if(auth()->user()->rol?->codigo === 'ADMIN_GLOBAL')
                            <select id="crearUsuarioEntidad" name="entidad_id" required
                                class="w-full text-sm border border-gray-300 rounded-md px-3 py-2">
                                <option value="">Seleccione</option>
                                @foreach($entidades as $entidad)
                                    <option value="{{ $entidad->id }}" @selected(old('entidad_id') == $entidad->id)>
                                        {{ $entidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <div id="crearUsuarioEntidad" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 bg-gray-50 text-gray-700">
                                {{ auth()->user()->entidad?->nombre }}
                            </div>
                            <input type="hidden" name="entidad_id" value="{{ auth()->user()->entidad_id }}">
                        @endif
                    </div>

                </div>

                <!-- Información de contraseña -->
                <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-md">
                    <p class="text-sm text-blue-800">
                        <i class="bi bi-info-circle"></i>
                        El usuario será creado con la contraseña temporal:
                        <strong>12345678</strong>
                    </p>
                </div>

            </div>


            <!-- Acciones -->
            <div class="flex shrink-0 flex-wrap justify-end gap-3 border-t border-gray-200 bg-white px-6 py-4">
                <button
                    type="submit"
                    class="inline-flex h-10 items-center justify-center gap-2
                           rounded-md bg-[#024687] px-5 text-sm font-medium
                           text-white hover:bg-[#01325f]">
                    <i class="bi bi-check-circle" aria-hidden="true"></i> Guardar
                </button>
                <button
                    type="button"
                    data-cerrar-panel-crear-usuario
                    class="inline-flex h-10 items-center justify-center
                           rounded-md bg-gray-200 px-5 text-sm
                           font-medium text-gray-700 hover:bg-gray-300">

                    Cancelar

                </button>
            </div>
        </form>
    </dialog>

    <style>
        #panelCrearUsuario::backdrop { background: rgb(0 0 0 / 20%); }
        #panelCrearUsuario .flex.items-center:has(> label),
        #panelCrearUsuario .flex.items-start:has(> label) {
            flex-direction: column;
            align-items: stretch;
            gap: 0.25rem;
        }
        #panelCrearUsuario label,
        #panelCrearUsuario input:not([type="hidden"]),
        #panelCrearUsuario select,
        #panelCrearUsuario textarea {
            width: 100%;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const panel = document.getElementById('panelCrearUsuario');
            const formulario = document.getElementById('formularioCrearUsuario');
            let ultimoBoton = null;

            document.querySelectorAll('[data-crear-usuario]').forEach(boton => {
                boton.addEventListener('click', function (evento) {
                    evento.preventDefault();
                    ultimoBoton = boton;
                    if (!panel.open) panel.showModal();
                });
            });

            panel.querySelectorAll('[data-cerrar-panel-crear-usuario]').forEach(boton => {
                boton.addEventListener('click', () => panel.close());
            });

            panel.addEventListener('close', function () {
                formulario.reset();
                ultimoBoton?.focus();
            });

            if ({{ Illuminate\Support\Js::from(
                old('_crear_usuario_panel') === '1' && $errors->any()
            ) }}) {
                panel.showModal();
            }
        });
    </script>

@endif
