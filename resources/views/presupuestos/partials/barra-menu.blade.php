<!-- Barra de acciones -->
<div class="bg-white border-b border-gray-300 mb-0">

    <div class="flex flex-wrap items-center">

        <!-- Regresar -->
        <a href="{{ route('presupuestos.listar') }}"
           class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

            <i class="bi bi-chevron-left" aria-hidden="true"></i>
            Regresar

        </a>


        <!-- Editar -->
        @if($presupuesto->estado === 'Borrador' && puedeHacer('presupuestos', 'editar'))

            <a href="{{ route('presupuestos.edit', $presupuesto) }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-pencil text-blue-500 me-2" aria-hidden="true"></i>
                Editar información

            </a>

        @endif


        <!-- Reabrir presupuesto -->
        @if($presupuesto->estado === 'Cerrado' && puedeHacer('presupuestos', 'reabrir'))

            <form method="POST"
                  action="{{ route('presupuestos.reabrir', $presupuesto) }}"
                  onsubmit="return confirm('¿Desea reabrir este presupuesto? Volverá a Borrador y podrá editarse por los usuarios autorizados.');">

                @csrf
                @method('PUT')

                <button type="submit"
                        class="inline-flex items-center px-3 py-2 text-sm
                               text-gray-700 hover:bg-gray-100 transition">

                    <i class="bi bi-unlock text-blue-500 me-2"
                       aria-hidden="true"></i>
                    Reabrir presupuesto

                </button>

            </form>

        @endif


        <!-- Actualizar -->
        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

            <i class="bi bi-arrow-clockwise text-blue-500 me-1" aria-hidden="true"></i>
            Actualizar

        </a>

    </div>

</div>