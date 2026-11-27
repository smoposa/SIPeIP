@if(puedeHacer('entidades', 'crear'))

    <!-- Panel lateral de creación de entidades -->
    <dialog id="panelCrearEntidad" aria-labelledby="tituloPanelCrearEntidad"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 600px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioCrearEntidad"
            method="POST"
            action="{{ route('entidades.store') }}"
            class="flex h-full flex-col">

            @csrf

            <input type="hidden" name="_crear_entidad_panel" value="1">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">
                <div class="min-w-0">
                    <h2 id="tituloPanelCrearEntidad"
                        class="text-xl font-semibold text-gray-800">

                        Crear entidad

                    </h2>
                    <p class="mt-1 break-words text-sm text-gray-500">
                        Registre una nueva entidad dentro del sistema.
                    </p>
                </div>
                <button
                    type="button"
                    data-cerrar-panel-crear-entidad
                    aria-label="Cerrar panel"
                    class="shrink-0 p-2 text-gray-500
                           hover:bg-gray-100 hover:text-gray-800">
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </button>
            </div>


            <!-- Campos -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                @if(old('_crear_entidad_panel') === '1' && $errors->any())

                    <div role="alert" class="mb-5 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">

                        @foreach($errors->all() as $error)

                            <p>{{ $error }}</p>

                        @endforeach

                    </div>

                @endif

                @include('entidades.partials.form')

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
                    data-cerrar-panel-crear-entidad
                    class="inline-flex h-10 items-center justify-center
                           rounded-md bg-gray-200 px-5 text-sm
                           font-medium text-gray-700 hover:bg-gray-300">

                    Cancelar

                </button>
            </div>
        </form>
    </dialog>

    <style>
        #panelCrearEntidad::backdrop { background: rgb(0 0 0 / 20%); }
        #panelCrearEntidad .flex.items-center:has(> label),
        #panelCrearEntidad .flex.items-start:has(> label) {
            flex-direction: column;
            align-items: stretch;
            gap: 0.25rem;
        }
        #panelCrearEntidad label,
        #panelCrearEntidad input:not([type="hidden"]),
        #panelCrearEntidad select,
        #panelCrearEntidad textarea {
            width: 100%;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const panel = document.getElementById('panelCrearEntidad');
            const formulario = document.getElementById('formularioCrearEntidad');
            let ultimoBoton = null;

            document.querySelectorAll('[data-crear-entidad]').forEach(boton => {
                boton.addEventListener('click', function (evento) {
                    evento.preventDefault();
                    ultimoBoton = boton;
                    if (!panel.open) panel.showModal();
                });
            });

            panel.querySelectorAll('[data-cerrar-panel-crear-entidad]').forEach(boton => {
                boton.addEventListener('click', () => panel.close());
            });

            panel.addEventListener('close', function () {
                formulario.reset();
                ultimoBoton?.focus();
            });

            if ({{ Illuminate\Support\Js::from(
                old('_crear_entidad_panel') === '1' && $errors->any()
            ) }}) {
                panel.showModal();
            }
        });
    </script>

@endif
