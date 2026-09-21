<!-- Barra de acciones -->
<div class="mb-0 border-b border-gray-300 bg-white">

    <div class="flex flex-wrap items-center gap-1">

        <!-- Regresar -->
        <a href="{{ route('objetivos.listar') }}"
           class="mr-6 py-2 text-sm font-medium text-blue-600
                  hover:text-blue-800">

            <i class="bi bi-chevron-left"></i>
            Regresar

        </a>

        <!-- Editar información -->
        <a href="{{ route('objetivos.edit', $objetivo->id) }}"
           class="px-3 py-2 text-sm text-gray-700
                  transition hover:bg-gray-100">

            <i class="bi bi-pencil me-2 text-blue-500"></i>
            Editar información

        </a>

        <!-- Editar estado -->
        <a href="{{ route('objetivos.editarestado', $objetivo->id) }}"
           class="px-3 py-2 text-sm text-gray-700
                  transition hover:bg-gray-100">

            <i class="bi bi-check2-circle me-2 text-blue-500"></i>
            Editar estado

        </a>

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

        <!-- Registrar meta -->
        @if(puedeVer('metas') && $objetivo->estado === 'Activo')

            <a href="{{ route('metas.create', ['objetivo_id' => $objetivo->id]) }}"
               class="px-3 py-2 text-sm font-medium text-green-700
                      transition hover:bg-green-50">

                <i class="bi bi-plus-circle me-2"></i>
                Registrar meta

            </a>

        @endif

    </div>

</div>