<!-- Barra de acciones -->
<div class="mb-0 border-b border-gray-300 bg-white">

    <div class="flex flex-wrap items-center">

        <a href="{{ route('indicadores.listar') }}"
           class="mr-8 py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800">

            <i class="bi bi-chevron-left"></i>
            Regresar

        </a>

        @if(puedeHacer('indicadores', 'editar'))

            <a href="{{ route('indicadores.edit', $indicador->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-pencil me-2 text-blue-500"></i>
                Editar información

            </a>

        @endif

        @if(puedeHacer('indicadores', 'estado'))

            <a href="{{ route('indicadores.editarestado', $indicador->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-check2-circle me-2 text-blue-500"></i>
                Editar estado

            </a>

        @endif

        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700
                  transition hover:bg-gray-100">

            <i class="bi bi-arrow-clockwise me-2 text-blue-500"></i>
            Actualizar

        </a>

    </div>

</div>