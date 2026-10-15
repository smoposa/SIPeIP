<!-- Panel lateral de la meta -->
<dialog
    id="panelMeta"
    aria-labelledby="tituloPanelMeta"
    class="bg-white p-0 shadow-xl"
    style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
           width: min(100%, 480px); height: 100dvh;
           max-width: 100%; max-height: none; border: 0;">

    <form
        id="formularioMeta"
        method="POST"
        action="{{ route('ods.metas.store', ['ods' => $ods->id]) }}"
        class="flex h-full flex-col">

        @csrf

        <input
            type="hidden"
            name="_method"
            id="metodoMeta"
            value="POST">

        <input
            type="hidden"
            name="_meta_form"
            id="origenMeta"
            value="crear">


        <!-- Encabezado del panel -->
        <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">

            <div class="min-w-0">

                <h2 id="tituloPanelMeta"
                    class="text-xl font-semibold text-gray-800">

                    Información de la meta

                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $ods->codigo }}
                </p>

            </div>


            <button
                type="button"
                data-cerrar-panel-meta
                aria-label="Cerrar panel"
                class="shrink-0 p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-800">

                <i class="bi bi-x-lg" aria-hidden="true"></i>

            </button>

        </div>


        <!-- Campos -->
        <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

            <!-- Errores del formulario -->
            @if($errors->any() && old('_meta_form') !== null)

                <div
                    id="erroresPanelMeta"
                    role="alert"
                    class="mb-5 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">

                    @foreach($errors->all() as $error)

                        <p>{{ $error }}</p>

                    @endforeach

                </div>

            @endif


            <div class="space-y-5">

                <!-- Código -->
                <div>

                    <label for="codigoMeta"
                           class="block text-sm font-medium text-gray-700">

                        Código <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        id="codigoMeta"
                        name="codigo"
                        maxlength="20"
                        required
                        disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100">

                </div>


                <!-- Título -->
                <div>

                    <label for="nombreMeta"
                           class="block text-sm font-medium text-gray-700">

                        Título <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        id="nombreMeta"
                        name="nombre"
                        maxlength="255"
                        required
                        disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100">

                </div>


                <!-- Descripción -->
                <div>

                    <label for="descripcionMeta"
                           class="block text-sm font-medium text-gray-700">

                        Descripción

                    </label>

                    <textarea
                        id="descripcionMeta"
                        name="descripcion"
                        rows="7"
                        maxlength="10000"
                        disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100"></textarea>

                </div>


                <!-- Estado -->
                <div>

                    <input
                        type="hidden"
                        id="estadoMetaInactivo"
                        name="estado"
                        value="Inactivo"
                        disabled>

                    <label for="estadoMeta"
                           class="inline-flex items-center gap-3 text-sm text-gray-700">

                        <input
                            type="checkbox"
                            id="estadoMeta"
                            name="estado"
                            value="Activo"
                            disabled
                            class="w-5 h-5">

                        Meta habilitada

                    </label>

                    <p class="mt-2 text-xs text-gray-500">
                        Al desactivar la meta, su información se conserva.
                    </p>

                </div>


                @if($ods->estado === 'Inactivo' || $ods->agenda?->estado === 'Inactivo')

                    <p class="text-sm text-amber-700">
                        El objetivo o su agenda están inactivos. Una meta activa
                        no estará disponible para nuevas alineaciones mientras
                        sus niveles superiores permanezcan inactivos.
                    </p>

                @endif

            </div>

        </div>


        <!-- Botones -->
        <div class="flex shrink-0 flex-wrap gap-3 border-t border-gray-200 bg-white px-6 py-4">

            <!-- Activar edición -->
            @if(puedeHacer('ods', 'editar') || puedeHacer('ods', 'estado'))

                <button
                    type="button"
                    id="editarPanelMeta"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                           text-white px-5 py-2 rounded-md">

                    Editar

                </button>

            @endif


            <!-- Guardar cambios -->
            <button
                type="submit"
                id="guardarPanelMeta"
                hidden
                disabled
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                Guardar

            </button>


            <!-- Cerrar o cancelar -->
            <button
                type="button"
                id="cerrarPanelMeta"
                data-cerrar-panel-meta
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                Cerrar

            </button>

        </div>

    </form>

</dialog>


<style>
    #panelMeta::backdrop {
        background: rgb(0 0 0 / 20%);
    }

    #panelMeta [hidden] {
        display: none !important;
    }
</style>