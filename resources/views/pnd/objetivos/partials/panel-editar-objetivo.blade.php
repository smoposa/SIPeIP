<!-- Panel lateral del objetivo -->
<dialog
    id="panelObjetivoPnd"
    aria-labelledby="tituloPanelObjetivoPnd"
    class="bg-white p-0 shadow-xl"
    style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
           width: min(100%, 480px); height: 100dvh;
           max-width: 100%; max-height: none; border: 0;">

    <form
        id="formularioObjetivoPnd"
        method="POST"
        action="{{ route('pnd.objetivos.store', ['eje' => $eje->id]) }}"
        class="flex h-full flex-col">

        @csrf

        <input
            type="hidden"
            name="_method"
            id="metodoObjetivoPnd"
            value="POST">

        <input
            type="hidden"
            name="_objetivo_pnd_form"
            id="origenObjetivoPnd">


        <!-- Encabezado -->
        <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">

            <div class="min-w-0">

                <h2 id="tituloPanelObjetivoPnd"
                    class="text-xl font-semibold text-gray-800">

                    Información del objetivo

                </h2>

                <p class="mt-1 text-sm text-gray-500 break-words">
                    Eje {{ $eje->numero }} · {{ $eje->nombre }}
                </p>

            </div>


            <button
                type="button"
                data-cerrar-panel-objetivo-pnd
                aria-label="Cerrar panel"
                class="shrink-0 p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-800">

                <i class="bi bi-x-lg" aria-hidden="true"></i>

            </button>

        </div>


        <!-- Campos -->
        <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

            <!-- Errores de validación -->
            @if($errors->any() && old('_objetivo_pnd_form') !== null)

                <div
                    id="erroresPanelObjetivoPnd"
                    role="alert"
                    class="mb-5 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">

                    @foreach($errors->all() as $error)

                        <p>{{ $error }}</p>

                    @endforeach

                </div>

            @endif


            <div class="space-y-5">

                <!-- Número -->
                <div>

                    <label for="numeroObjetivoPnd"
                           class="block text-sm font-medium text-gray-700">

                        Número <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="number"
                        id="numeroObjetivoPnd"
                        name="numero"
                        min="1"
                        step="1"
                        required
                        disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100">

                </div>


                <!-- Nombre -->
                <div>

                    <label for="nombreObjetivoPnd"
                           class="block text-sm font-medium text-gray-700">

                        Nombre <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        id="nombreObjetivoPnd"
                        name="nombre"
                        maxlength="150"
                        required
                        disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100">

                </div>


                <!-- Descripción -->
                <div>

                    <label for="descripcionObjetivoPnd"
                           class="block text-sm font-medium text-gray-700">

                        Descripción

                    </label>

                    <textarea
                        id="descripcionObjetivoPnd"
                        name="descripcion"
                        rows="7"
                        maxlength="10000"
                        disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100"></textarea>

                </div>


                <!-- Estado -->
                <div id="grupoEstadoObjetivoPnd">

                    <input
                        type="hidden"
                        id="estadoObjetivoPndInactivo"
                        name="estado"
                        value="Inactivo"
                        disabled>

                    <label for="estadoObjetivoPnd"
                           class="inline-flex items-center gap-3 text-sm text-gray-700">

                        <input
                            type="checkbox"
                            id="estadoObjetivoPnd"
                            name="estado"
                            value="Activo"
                            disabled
                            class="w-5 h-5">

                        Objetivo habilitado

                    </label>

                    <p class="mt-2 text-xs text-gray-500">
                        Al desactivar el objetivo, su información, políticas,
                        estrategias y metas se conservan para consulta.
                    </p>

                </div>

            </div>

        </div>


        <!-- Botones -->
        <div class="flex shrink-0 flex-wrap gap-3 border-t border-gray-200 bg-white px-6 py-4">

            <!-- Activar edición -->
            @if(puedeHacer('pnd', 'editar') || puedeHacer('pnd', 'estado'))

                <button
                    type="button"
                    id="editarPanelObjetivoPnd"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                    Editar

                </button>

            @endif


            <!-- Guardar -->
            <button
                type="submit"
                id="guardarPanelObjetivoPnd"
                hidden
                disabled
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                Guardar

            </button>


            <!-- Cerrar o cancelar -->
            <button
                type="button"
                id="cerrarPanelObjetivoPnd"
                data-cerrar-panel-objetivo-pnd
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                Cerrar

            </button>

        </div>

    </form>

</dialog>


<style>
    #panelObjetivoPnd::backdrop {
        background: rgb(0 0 0 / 20%);
    }

    #panelObjetivoPnd [hidden] {
        display: none !important;
    }
</style>