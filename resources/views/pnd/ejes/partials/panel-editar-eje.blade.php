<!-- Panel lateral -->
<dialog
    id="panelEjePnd"
    aria-labelledby="tituloPanelEjePnd"
    class="bg-white p-0 shadow-xl"
    style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
           width: min(100%, 480px); height: 100dvh;
           max-width: 100%; max-height: none; border: 0;">

    <form
        id="formularioEjePnd"
        method="POST"
        action="{{ route('pnd.ejes.store', ['pnd' => $pnd->id]) }}"
        class="flex h-full flex-col">

        @csrf

        <input
            type="hidden"
            name="_method"
            id="metodoEjePnd"
            value="POST">

        <input
            type="hidden"
            name="_eje_form"
            id="origenEjePnd">


        <!-- Encabezado -->
        <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">

            <div class="min-w-0">

                <h2 id="tituloPanelEjePnd"
                    class="text-xl font-semibold text-gray-800">

                    Información del eje

                </h2>

                <p class="mt-1 text-sm text-gray-500 break-words">
                    {{ $pnd->nombre }}
                </p>

            </div>


            <button
                type="button"
                data-cerrar-panel-eje-pnd
                aria-label="Cerrar panel"
                class="shrink-0 p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-800">

                <i class="bi bi-x-lg" aria-hidden="true"></i>

            </button>

        </div>


        <!-- Campos -->
        <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

            <!-- Errores -->
            @if($errors->any() && old('_eje_form') !== null)

                <div
                    id="erroresPanelEjePnd"
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

                    <label for="numeroEjePnd"
                           class="block text-sm font-medium text-gray-700">

                        Número <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="number"
                        id="numeroEjePnd"
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

                    <label for="nombreEjePnd"
                           class="block text-sm font-medium text-gray-700">

                        Nombre <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        id="nombreEjePnd"
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

                    <label for="descripcionEjePnd"
                           class="block text-sm font-medium text-gray-700">

                        Descripción

                    </label>

                    <textarea
                        id="descripcionEjePnd"
                        name="descripcion"
                        rows="7"
                        maxlength="10000"
                        disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100"></textarea>

                </div>


                <!-- Estado -->
                <div id="grupoEstadoEjePnd">

                    <input
                        type="hidden"
                        id="estadoEjePndInactivo"
                        name="estado"
                        value="Inactivo"
                        disabled>

                    <label for="estadoEjePnd"
                           class="inline-flex items-center gap-3 text-sm text-gray-700">

                        <input
                            type="checkbox"
                            id="estadoEjePnd"
                            name="estado"
                            value="Activo"
                            disabled
                            class="w-5 h-5">

                        Eje habilitado

                    </label>

                    <p class="mt-2 text-xs text-gray-500">
                        Al desactivar el eje, su información y sus objetivos
                        se conservan para consulta.
                    </p>

                </div>

            </div>

        </div>


        <!-- Botones -->
        <div class="flex shrink-0 flex-wrap gap-3 border-t border-gray-200 bg-white px-6 py-4">

            @if(puedeHacer('pnd', 'editar') || puedeHacer('pnd', 'estado'))

                <button
                    type="button"
                    id="editarPanelEjePnd"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                    Editar

                </button>

            @endif


            <button
                type="submit"
                id="guardarPanelEjePnd"
                hidden
                disabled
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                Guardar

            </button>


            <button
                type="button"
                id="cerrarPanelEjePnd"
                data-cerrar-panel-eje-pnd
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                Cerrar

            </button>

        </div>

    </form>

</dialog>


<style>
    #panelEjePnd::backdrop {
        background: rgb(0 0 0 / 20%);
    }

    #panelEjePnd [hidden] {
        display: none !important;
    }
</style>