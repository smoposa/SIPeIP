<!-- Estado de la entidad -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado de la entidad
        </h4>

    </div>

</div>


<!-- Estado actual -->
<div class="px-4 py-2">

    <div class="flex flex-wrap items-center gap-y-2 mb-4">

        <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
            Estado
        </span>


        @if($entidad->estado === 'Activo')

            <span class="px-2 py-1 text-xs rounded-full
                         bg-green-100 text-green-700">
                Activo
            </span>

        @else

            <span class="px-2 py-1 text-xs rounded-full
                         bg-red-100 text-red-700">
                Inactivo
            </span>

        @endif


        @if(puedeHacer('entidades', 'estado'))

            <button
                type="button"
                data-editar-estado-entidad
                aria-haspopup="dialog"
                aria-controls="panelEstadoEntidad"
                class="ml-10 text-sm text-blue-600
                       hover:text-blue-800 hover:underline">

                Editar

            </button>

        @endif

    </div>

</div>