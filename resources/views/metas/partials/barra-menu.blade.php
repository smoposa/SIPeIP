<!-- Barra de acciones -->
<div class="mb-0 border-b border-gray-300 bg-white">

    <div class="flex flex-wrap items-center">

        <a href="{{ route('metas.listar') }}"
           class="mr-8 py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800">

            <i class="bi bi-chevron-left"></i>
            Regresar

        </a>

        @if(puedeHacer('metas', 'editar'))

            <a href="{{ route('metas.edit', $meta->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-pencil me-2 text-blue-500"></i>
                Editar información

            </a>

        @endif

        @if(puedeHacer('metas', 'estado'))

            <a href="{{ route('metas.editarestado', $meta->id) }}"
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

        <!-- Separador visual -->
        <span class="px-2 text-gray-300"> | </span>

        @if(puedeVer('indicadores') && $meta->estado === 'Activo')

            <a href="{{ route('indicadores.create', ['meta_id' => $meta->id]) }}"
               class="px-3 py-2 text-sm font-medium text-green-700
                      hover:bg-green-50">

                <i class="bi bi-plus-circle me-2"></i>
                Registrar indicador

            </a>

        @endif

    </div>

</div>