@if(puedeHacer('roles', 'editar'))

    <!-- Panel lateral de permisos -->
    <dialog id="panelPermisosRol" aria-labelledby="tituloPanelPermisosRol"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 600px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioPermisosRol"
            method="POST"
            action="{{ route('roles.actualizarpermisos', $rol->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input type="hidden" name="_rol_permisos_form" value="{{ $rol->id }}">



            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">
                <div class="min-w-0">
                    <h2 id="tituloPanelPermisosRol"
                        class="text-xl font-semibold text-gray-800">

                        Editar permisos

                    </h2>
                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $rol->nombre }}
                    </p>
                </div>
                <button
                    type="button"
                    data-cerrar-panel-permisos
                    aria-label="Cerrar panel"
                    class="shrink-0 p-2 text-gray-500
                           hover:bg-gray-100 hover:text-gray-800">
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </button>
            </div>


            <!-- Campos -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">
                @if((string) old('_rol_permisos_form') === (string) $rol->id && $errors->any())

                    <div role="alert" class="mb-5 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">

                        @foreach($errors->all() as $error)

                            <p>{{ $error }}</p>

                        @endforeach

                    </div>

                @endif

                @include('roles.partials.permisos', [
                    'permisos' => auth()->user()->rol->permisos,
                    'permisosSeleccionados' => $rol->permisos->modelKeys(),
                ])
            </div>


            <!-- Acciones -->
            <div class="flex shrink-0 flex-wrap justify-end gap-3 border-t border-gray-200 bg-white px-6 py-4">
                <button
                    type="submit"
                    id="btnGuardarPermisosRol"
                    disabled
                    class="inline-flex h-10 items-center justify-center gap-2
                           rounded-md bg-[#024687] px-5 text-sm font-medium
                           text-white hover:bg-[#01325f] disabled:opacity-50
                           disabled:cursor-not-allowed">
                    <i class="bi bi-check-circle" aria-hidden="true"></i> Guardar cambios
                </button>
                <button
                    type="button"
                    data-cerrar-panel-permisos
                    class="inline-flex h-10 items-center justify-center
                           rounded-md bg-gray-200 px-5 text-sm
                           font-medium text-gray-700 hover:bg-gray-300">

                    Cancelar

                </button>
            </div>
        </form>
    </dialog>

    <style>
        #panelPermisosRol::backdrop { background: rgb(0 0 0 / 20%); }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const panel = document.getElementById('panelPermisosRol');
            const formulario = document.getElementById('formularioPermisosRol');
            let ultimoBoton = null;

            const guardar = document.getElementById('btnGuardarPermisosRol');
            const protegido = {{ Illuminate\Support\Js::from(
                in_array($rol->codigo, ['ADMIN_GLOBAL', 'ADMIN_SISTEMA'], true)
                || (int) auth()->user()->rol->id === (int) $rol->id
                || !in_array(auth()->user()->rol->codigo, ['ADMIN_GLOBAL', 'ADMIN_SISTEMA'], true)
                || $rol->permisos->modelKeys() !== array_values(array_intersect(
                    $rol->permisos->modelKeys(), auth()->user()->rol->permisos->modelKeys()
                ))
            ) }};

            // Habilitar el guardado cuando exista una selección válida.
            function actualizarBoton() {
                guardar.disabled = protegido
                    || !formulario.querySelector('input[name="permisos[]"]:checked');
            }

            formulario.addEventListener('change', actualizarBoton);
            formulario.addEventListener('submit', function (evento) {
                actualizarBoton();
                if (guardar.disabled) {
                    evento.preventDefault();
                }
            });

            actualizarBoton();

            if ({{ Illuminate\Support\Js::from((string) old('_rol_permisos_form') === (string) $rol->id && $errors->any()) }}) {
                panel.showModal();
            }

            document.querySelectorAll('[data-editar-permisos-rol]').forEach(boton => {
                boton.setAttribute('aria-haspopup', 'dialog');
                boton.setAttribute('aria-controls', panel.id);
                boton.addEventListener('click', () => {
                    ultimoBoton = boton;
                    if (!panel.open) panel.showModal();
                });
            });
            panel.querySelectorAll('[data-cerrar-panel-permisos]').forEach(boton => {
                boton.addEventListener('click', () => panel.close());
            });
            panel.addEventListener('close', () => {
                formulario.reset();
                formulario.querySelector('[data-permisos]')?.dispatchEvent(new Event('change', { bubbles: true }));
                panel.querySelectorAll('details').forEach(grupo => grupo.open = false);
                ultimoBoton?.focus();
            });
        });
    </script>

@endif
