<div class="flex items-center justify-center gap-2">

    <!-- Detalle -->
    <a href="{{ route('proyectos.detalle', $proyecto->id) }}"
       title="Ver detalle"
       aria-label="Ver detalle de {{ $proyecto->nombre }}"
       class="inline-flex h-8 w-8 items-center justify-center
              rounded-md border border-gray-300 bg-white
              text-gray-600 transition hover:bg-gray-100">

        <i class="bi bi-eye" aria-hidden="true"></i>

    </a>


    <!-- Editar -->
    @if(puedeHacer('proyectos', 'editar'))

        <a href="{{ route('proyectos.edit', $proyecto->id) }}"
           title="Editar proyecto"
           aria-label="Editar {{ $proyecto->nombre }}"
           class="inline-flex h-8 w-8 items-center justify-center
                  rounded-md border border-gray-300 bg-white
                  text-gray-600 transition hover:bg-gray-100">

            <i class="bi bi-pencil" aria-hidden="true"></i>

        </a>

    @endif

</div>