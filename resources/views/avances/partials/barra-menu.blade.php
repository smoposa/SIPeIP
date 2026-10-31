<!-- Barra de acciones -->
<div class="mb-0 border-b border-gray-300 bg-white">

    <div class="flex flex-wrap items-center">

        <!-- Regresar -->
        <a href="{{ route('avances.listar') }}"
           class="mr-8 py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800">

            <i class="bi bi-chevron-left" aria-hidden="true"></i>
            Regresar

        </a>


        <!-- Editar información -->
        @if($avance->estado === 'Borrador' && puedeHacer('avances', 'editar'))

            <a href="{{ route('avances.edit', $avance) }}"
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-pencil me-2 text-blue-500"
                   aria-hidden="true"></i>
                Editar información

            </a>

        @endif


        <!-- Actualizar -->
        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700
                  transition hover:bg-gray-100">

            <i class="bi bi-arrow-clockwise me-2 text-blue-500"
               aria-hidden="true"></i>
            Actualizar

        </a>

    </div>

</div>