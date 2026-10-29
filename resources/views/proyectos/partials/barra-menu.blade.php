<!-- Barra de acciones -->
<div class="bg-white border-b border-gray-300 mb-0">

    <div class="flex flex-wrap">

        <!-- Regresar -->
        <a href="{{ route('proyectos.listar') }}"
           class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

            <i class="bi bi-chevron-left" aria-hidden="true"></i>
            Regresar

        </a>


        <!-- Editar -->
        @if(puedeHacer('proyectos', 'editar'))

            <a href="{{ route('proyectos.edit', $proyecto->id) }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-pencil text-blue-500 me-2" aria-hidden="true"></i>
                Editar información

            </a>

        @endif


        <!-- Registrar avance -->
        @if(puedeHacer('avances', 'crear'))

            <a href="{{ route('avances.create', ['proyecto_id' => $proyecto->id]) }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-graph-up-arrow text-blue-500 me-2" aria-hidden="true"></i>
                Registrar avance

            </a>

        @endif


        <!-- Registrar presupuesto -->
        @if(puedeHacer('presupuestos', 'crear'))

            <a href="{{ route('presupuestos.create', ['proyecto_id' => $proyecto->id]) }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-cash-coin text-blue-500 me-2" aria-hidden="true"></i>
                Registrar presupuesto

            </a>

        @endif


        <!-- Actualizar -->
        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

            <i class="bi bi-arrow-clockwise text-blue-500 me-1" aria-hidden="true"></i>
            Actualizar

        </a>

    </div>

</div>