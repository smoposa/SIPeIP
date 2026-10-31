<!-- Barra de acciones -->
<div class="bg-white border-b border-gray-300 mb-0">

    <div class="flex flex-wrap items-center">

        <!-- Regresar -->
        <a href="{{ route('roles.index') }}"
           class="py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800 mr-8">

            <i class="bi bi-chevron-left" aria-hidden="true"></i>
            Regresar

        </a>


        <!-- Editar información -->
        @if(puedeHacer('roles', 'editar'))

            <a href="{{ route('roles.edit', $rol->id) }}"
               data-editar-rol
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-pencil text-blue-500 me-2"
                   aria-hidden="true"></i>
                Editar información

            </a>

        @endif


        <!-- Editar estado -->
        @if(puedeHacer('roles', 'estado'))

            <a href="{{ route('roles.estado', $rol->id) }}"
               data-editar-estado-rol
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-toggle-on text-blue-500 me-2"
                   aria-hidden="true"></i>
                Editar estado

            </a>

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