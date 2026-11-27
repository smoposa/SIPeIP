@if(puedeHacer('roles', 'crear'))

    <!-- Panel lateral de creación de roles -->
    <dialog id="panelCrearRol" aria-labelledby="tituloPanelCrearRol"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 600px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioCrearRol"
            method="POST"
            action="{{ route('roles.store') }}"
            class="flex h-full flex-col">

            @csrf

            <input type="hidden" name="_crear_rol_panel" value="1">



            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">
                <div class="min-w-0">
                    <h2 id="tituloPanelCrearRol"
                        class="text-xl font-semibold text-gray-800">

                        Crear rol

                    </h2>
                    <p class="mt-1 break-words text-sm text-gray-500">
                        Registre un nuevo rol dentro del sistema.
                    </p>
                </div>
                <button
                    type="button"
                    data-cerrar-panel-crear-rol
                    aria-label="Cerrar panel"
                    class="shrink-0 p-2 text-gray-500
                           hover:bg-gray-100 hover:text-gray-800">
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </button>
            </div>


            <!-- Campos -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">
                @if(old('_crear_rol_panel') === '1' && $errors->any())

                    <div role="alert" class="mb-5 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">

                        @foreach($errors->all() as $error)

                            <p>{{ $error }}</p>

                        @endforeach

                    </div>

                @endif

                <!-- Nombre y descripción -->
                <div class="space-y-4">

                    <div>
                        <label for="nombreCrearRol" class="block mb-1 text-sm font-medium text-gray-700">
                            Nombre del rol <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="nombreCrearRol"
                            type="text"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            maxlength="100"
                            required
                            class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm
                                   focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="descripcionCrearRol" class="block mb-1 text-sm font-medium text-gray-700">
                            Descripción <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="descripcionCrearRol"
                            name="descripcion"
                            rows="4"
                            maxlength="255"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                   focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion') }}</textarea>
                    </div>

                </div>

                @include('roles.partials.permisos', [
                    'permisos' => auth()->user()->rol->permisos,
                    'permisosSeleccionados' => [],
                ])
            </div>


            <!-- Acciones -->
            <div class="flex shrink-0 flex-wrap justify-end gap-3 border-t border-gray-200 bg-white px-6 py-4">
                <button
                    type="submit"
                    id="btnGuardarCrearRol"
                    disabled
                    class="inline-flex h-10 items-center justify-center gap-2
                           rounded-md bg-[#024687] px-5 text-sm font-medium
                           text-white hover:bg-[#01325f] disabled:opacity-50
                           disabled:cursor-not-allowed">
                    <i class="bi bi-check-circle" aria-hidden="true"></i> Guardar
                </button>
                <button
                    type="button"
                    data-cerrar-panel-crear-rol
                    class="inline-flex h-10 items-center justify-center
                           rounded-md bg-gray-200 px-5 text-sm
                           font-medium text-gray-700 hover:bg-gray-300">

                    Cancelar

                </button>
            </div>
        </form>
    </dialog>

    <style>
        #panelCrearRol::backdrop { background: rgb(0 0 0 / 20%); }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const panel = document.getElementById('panelCrearRol');
            const formulario = document.getElementById('formularioCrearRol');
            const guardar = document.getElementById('btnGuardarCrearRol');
            let ultimoBoton = null;

            function actualizarBoton() {
                guardar.disabled = !formulario.elements.nombre.value.trim()
                    || !formulario.elements.descripcion.value.trim()
                    || !formulario.querySelector('input[name="permisos[]"]:checked');
            }

            formulario.addEventListener('input', actualizarBoton);
            formulario.addEventListener('change', actualizarBoton);
            formulario.addEventListener('submit', function (evento) {
                actualizarBoton();
                if (guardar.disabled) {
                    evento.preventDefault();
                }
            });

            document.querySelectorAll('[data-crear-rol]').forEach(boton => {
                boton.addEventListener('click', function (evento) {
                    evento.preventDefault();
                    ultimoBoton = boton;
                    if (!panel.open) panel.showModal();
                });
            });

            panel.querySelectorAll('[data-cerrar-panel-crear-rol]').forEach(boton => {
                boton.addEventListener('click', () => panel.close());
            });

            panel.addEventListener('close', function () {
                formulario.reset();
                formulario.querySelector('[data-permisos]')?.dispatchEvent(new Event('change', { bubbles: true }));
                panel.querySelectorAll('details').forEach(grupo => grupo.open = false);
                actualizarBoton();
                ultimoBoton?.focus();
            });

            actualizarBoton();

            if ({{ Illuminate\Support\Js::from(
                session('abrir_panel_rol') === 'crear'
                || (old('_crear_rol_panel') === '1' && $errors->any())
            ) }}) {
                panel.showModal();
            }
        });
    </script>

@endif
