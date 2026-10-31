<!-- Barra de acciones -->
<div class="mb-0 border-b border-gray-300 bg-white">

    <div class="flex flex-wrap items-center">

        <a href="{{ route('planes.listar') }}"
           class="mr-8 py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800">

            <i class="bi bi-chevron-left" aria-hidden="true"></i>
            Regresar

        </a>

        @if(puedeHacer('planes', 'editar'))

            <a href="{{ route('planes.edit', $plan->id) }}"
               data-editar-plan
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-pencil me-2 text-blue-500"
                   aria-hidden="true"></i>

                Editar información

            </a>

        @endif

        @if(puedeHacer('planes', 'estado'))

            <a href="{{ route('planes.editarestado', $plan->id) }}"
               data-editar-estado-plan
               class="px-3 py-2 text-sm text-gray-700
                      transition hover:bg-gray-100">

                <i class="bi bi-check2-circle me-2 text-blue-500"
                   aria-hidden="true"></i>

                Editar estado

            </a>

        @endif

        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700
                  transition hover:bg-gray-100">

            <i class="bi bi-arrow-clockwise me-2 text-blue-500"
               aria-hidden="true"></i>

            Actualizar

        </a>

        @if(
            puedeVer('objetivos')
            && puedeHacer('objetivos', 'crear')
            && $plan->estado === 'Activo'
        )

            <span class="px-2 text-gray-300" aria-hidden="true">|</span>

            <a href="{{ route('objetivos.create', ['plan_id' => $plan->id]) }}"
               class="inline-flex items-center px-3 py-2 text-sm
                      font-medium text-green-700 transition
                      hover:bg-green-50">

                <i class="bi bi-plus-circle me-2" aria-hidden="true"></i>
                Registrar OEI

            </a>

        @endif

    </div>

</div>