<dialog id="panelRegistroPnd"
    aria-labelledby="tituloPanelRegistroPnd"
    class="bg-white p-0 shadow-xl"
    style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
           width: min(100%, 480px); height: 100dvh;
           max-width: 100%; max-height: none; border: 0;">

    <form id="formRegistroPnd" method="POST" class="flex h-full flex-col">
        @csrf

        <input type="hidden" name="_method" id="metodoRegistroPnd" value="POST">
        <input type="hidden" name="_pnd_tipo" id="tipoRegistroPnd">
        <input type="hidden" name="_pnd_registro" id="idRegistroPnd">
        <input type="hidden" name="_pnd_padre" id="padreRegistroPnd">

        <!-- Encabezado -->
        <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">
            <div class="min-w-0">
                <h2 id="tituloPanelRegistroPnd" class="text-xl font-semibold text-gray-800">Información</h2>
                <p id="referenciaRegistroPnd" class="mt-1 text-sm text-gray-500 break-words"></p>
            </div>
            <button type="button" data-cerrar-registro-pnd aria-label="Cerrar panel"
                class="shrink-0 p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-800">
                <i class="bi bi-x-lg" aria-hidden="true"></i>
            </button>
        </div>

        <!-- Campos -->
        <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">
            @if($errors->any() && old('_pnd_tipo') !== null)
                <div id="erroresRegistroPnd" role="alert"
                    class="mb-5 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800" hidden>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="space-y-5">
                <div>
                    <label for="identificadorRegistroPnd" class="block text-sm font-medium text-gray-700">
                        <span id="etiquetaIdentificadorPnd">Código</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="identificadorRegistroPnd" name="codigo" required disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100">
                </div>

                <div id="grupoNombreRegistroPnd">
                    <label for="nombreRegistroPnd" class="block text-sm font-medium text-gray-700">
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <textarea id="nombreRegistroPnd" name="nombre" rows="5" maxlength="255" required disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100"></textarea>
                </div>

                <div id="grupoDescripcionRegistroPnd">
                    <label for="descripcionRegistroPnd" class="block text-sm font-medium text-gray-700">
                        Descripción <span class="text-red-500">*</span>
                    </label>
                    <textarea id="descripcionRegistroPnd" name="descripcion" rows="7" maxlength="10000" required disabled
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100"></textarea>
                </div>

                <div id="grupoEstadoRegistroPnd">
                    <input type="hidden" name="estado" value="Inactivo" id="inactivoRegistroPnd" disabled>
                    <label for="estadoRegistroPnd" class="inline-flex items-center gap-3 text-sm text-gray-700">
                        <input type="checkbox" id="estadoRegistroPnd" name="estado" value="Activo" disabled class="w-5 h-5">
                        <span id="etiquetaEstadoRegistroPnd">Registro habilitado</span>
                    </label>
                    <p class="mt-2 text-xs text-gray-500">
                        Al desactivar el registro, su información se conserva para consulta.
                    </p>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="flex shrink-0 flex-wrap gap-3 border-t border-gray-200 bg-white px-6 py-4">
            @if(puedeHacer('pnd', 'editar') || puedeHacer('pnd', 'estado'))
                <button type="button" id="editarRegistroPnd"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">Editar</button>
            @endif
            <button type="submit" id="guardarRegistroPnd" hidden disabled
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">Guardar</button>
            <button type="button" id="cerrarRegistroPnd" data-cerrar-registro-pnd
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">Cerrar</button>
        </div>
    </form>
</dialog>

<style>
    #panelRegistroPnd::backdrop { background: rgb(0 0 0 / 20%); }
    #panelRegistroPnd [hidden] { display: none !important; }
</style>
