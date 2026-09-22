<!-- Barra de acciones -->
<div class="mb-0 border-b border-gray-300 bg-white">

    <div class="flex flex-wrap items-center">

        <!-- Regresar -->
        <a href="{{ route('programas.listar') }}"
           class="mr-8 py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800">

            <i class="bi bi-chevron-left"></i>
            Regresar

        </a>

        <!-- Editar información -->
        @if(puedeHacer('programas', 'editar'))

            <a href="{{ route('programas.edit', $programa->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-pencil me-2 text-blue-500"></i>
                Editar información

            </a>

        @endif

        <!-- Editar estado -->
        @if(puedeHacer('programas', 'estado') && Route::has('programas.editarestado'))

            <a href="{{ route('programas.editarestado', $programa->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-check2-circle me-2 text-blue-500"></i>
                Editar estado

            </a>

        @endif

        <!-- Actualizar -->
        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700
                  transition hover:bg-gray-100">

            <i class="bi bi-arrow-clockwise me-2 text-blue-500"></i>
            Actualizar

        </a>

        <!-- Separador -->
        <span class="px-2 text-gray-300" aria-hidden="true">
            |
        </span>

        <!-- Registrar proyecto -->
        @if(puedeVer('proyectos') && $programa->estado === 'Activo')

            <a href="{{ route(
                'proyectos.create',
                ['programa_id' => $programa->id]
            ) }}"
               class="px-3 py-2 text-sm font-medium text-green-700
                      transition hover:bg-green-50">

                <i class="bi bi-plus-circle me-2"></i>
                Registrar proyecto

            </a>

        @endif

    </div>

</div>