<!-- Barra de acciones -->
<div class="bg-white border-b border-gray-300 mb-0">

    <div class="flex flex-wrap items-center">

        <!-- Regresar -->
        <a href="{{ route('entidades.index') }}"
           class="py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800 mr-8">

            <i class="bi bi-chevron-left" aria-hidden="true"></i>
            Regresar

        </a>


        <!-- Editar información -->
        @if(puedeHacer('entidades', 'editar'))

            <button
                type="button"
                data-editar-entidad
                aria-haspopup="dialog"
                aria-controls="panelEditarEntidad"
                class="px-3 py-2 text-sm text-gray-700
                       hover:bg-gray-100 transition">

                <i class="bi bi-pencil text-blue-500 me-2"
                   aria-hidden="true"></i>
                Editar información

            </button>

        @endif


        <!-- Editar estado -->
        @if(puedeHacer('entidades', 'estado'))

            <button
                type="button"
                data-editar-estado-entidad
                aria-haspopup="dialog"
                aria-controls="panelEstadoEntidad"
                class="px-3 py-2 text-sm text-gray-700
                       hover:bg-gray-100 transition">

                <i class="bi bi-toggle-on text-blue-500 me-2"
                   aria-hidden="true"></i>
                Editar estado

            </button>

        @endif


        <!-- Actualizar -->
        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700
                  hover:bg-gray-100 transition">

            <i class="bi bi-arrow-clockwise text-blue-500 me-2"
               aria-hidden="true"></i>
            Actualizar

        </a>

    </div>

</div>