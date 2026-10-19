<!-- Panel compartido por los tres niveles -->
<dialog id="panelClasificacion" aria-labelledby="tituloPanelClasificacion"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">
    <form id="formClasificacion" method="POST" class="flex h-full flex-col">
        @csrf
        <input type="hidden" name="_method" id="metodoClasificacion" value="POST">
        <input type="hidden" name="_clasificacion_form" id="origenClasificacion">
        <input type="hidden" name="_clasificacion_nivel" value="{{ $nivel }}">

        <div class="flex shrink-0 items-center justify-between gap-4 border-b border-gray-200 px-6 py-4">
            <div class="min-w-0">
                <h2 id="tituloPanelClasificacion" class="text-xl font-semibold text-gray-800">Información</h2>
                <p class="mt-1 text-sm text-gray-500 break-words">{{ $referencia }}</p>
            </div>
            <button type="button" data-cerrar-clasificacion aria-label="Cerrar panel"
                    class="shrink-0 p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-800">
                <i class="bi bi-x-lg" aria-hidden="true"></i>
            </button>
        </div>

        <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">
            @if($errors->any() && old('_clasificacion_nivel') === $nivel)
                <div id="erroresClasificacion" role="alert" hidden
                     class="mb-5 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="space-y-5">
                @unless($esMacrosector)
                    <div>
                        <label for="padreClasificacion" class="block text-sm font-medium text-gray-700">
                            {{ $esSector ? 'Macrosector' : 'Sector' }}
                        </label>
                        <input type="text" id="padreClasificacion" value="{{ $referencia }}" disabled
                               class="mt-1 w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-700 disabled:opacity-100">
                    </div>
                @endunless

                @if($esSubsector)
                    <div>
                        <label for="codigoClasificacion" class="block text-sm font-medium text-gray-700">
                            Código oficial <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="codigoClasificacion" name="codigo" maxlength="10"
                               required disabled pattern="[A-Za-z][0-9]{4}" aria-describedby="ayudaCodigoClasificacion"
                               class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm uppercase
                                      focus:border-blue-500 focus:ring-blue-500
                                      disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100">
                        <p id="ayudaCodigoClasificacion" class="mt-1 text-xs text-gray-500">
                            Una letra seguida de cuatro números. Ejemplo: A0102.
                        </p>
                    </div>
                @endif

                <div>
                    <label for="nombreClasificacion" class="block text-sm font-medium text-gray-700">
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nombreClasificacion" name="nombre"
                           maxlength="{{ $esSubsector ? 255 : 150 }}" required disabled
                           class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                                  focus:border-blue-500 focus:ring-blue-500
                                  disabled:bg-gray-50 disabled:text-gray-700 disabled:opacity-100">
                </div>

                @if($esSubsector)
                    <div>
                        <label for="nivelGobiernoClasificacion" class="block text-sm font-medium text-gray-700">Nivel de gobierno</label>
                        <input type="text" id="nivelGobiernoClasificacion" value="Nacional" disabled
                               class="mt-1 w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-700 disabled:opacity-100">
                    </div>
                @endif

                <div id="grupoEstadoClasificacion">
                    <input type="hidden" name="estado" id="inactivoClasificacion" value="Inactivo" disabled>
                    <label for="estadoClasificacion" class="inline-flex items-center gap-3 text-sm text-gray-700">
                        <input type="checkbox" name="estado" id="estadoClasificacion" value="Activo" disabled class="w-5 h-5">
                        {{ $etiqueta }} habilitado
                    </label>
                    <p class="mt-2 text-xs text-gray-500">
                        Al desactivar el registro, su información y sus relaciones se conservan para consulta.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex shrink-0 flex-wrap gap-3 border-t border-gray-200 bg-white px-6 py-4">
            @if(puedeHacer('clasificacion_inversion', 'editar') || puedeHacer('clasificacion_inversion', 'estado'))
                <button type="button" id="editarClasificacion"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">Editar</button>
            @endif
            <button type="submit" id="guardarClasificacion" hidden disabled
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">Guardar</button>
            <button type="button" id="cerrarClasificacion" data-cerrar-clasificacion
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">Cerrar</button>
        </div>
    </form>
</dialog>

<style>
    #panelClasificacion::backdrop { background: rgb(0 0 0 / 20%); }
    #panelClasificacion [hidden] { display: none !important; }
</style>
