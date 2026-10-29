<div class="flex items-center justify-center gap-2">

    <!-- Detalle -->
    <a href="{{ route('programas.detalle', $programa->id) }}"
       title="Ver detalle"
       aria-label="Ver detalle de {{ $programa->nombre }}"
       class="inline-flex h-8 w-8 items-center justify-center
              rounded-md border border-gray-300 bg-white
              text-gray-600 transition hover:bg-gray-100">

        <i class="bi bi-eye" aria-hidden="true"></i>

    </a>


    <!-- Editar -->
    @if(puedeHacer('programas', 'editar'))

        <a href="{{ route('programas.edit', $programa->id) }}"
           title="Editar programa"
           aria-label="Editar {{ $programa->nombre }}"
           class="inline-flex h-8 w-8 items-center justify-center
                  rounded-md border border-gray-300 bg-white
                  text-gray-600 transition hover:bg-gray-100">

            <i class="bi bi-pencil" aria-hidden="true"></i>

        </a>

    @endif


    <!-- Cambiar estado -->
    @if(puedeHacer('programas', 'estado'))

        <form method="POST"
              action="{{ route('programas.estado', $programa->id) }}">

            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="estado"
                value="{{ $programa->estado === 'Activo' ? 0 : 1 }}">

            <button
                type="submit"
                title="{{ $programa->estado === 'Activo' ? 'Inactivar programa' : 'Activar programa' }}"
                aria-label="{{ $programa->estado === 'Activo' ? 'Inactivar' : 'Activar' }} {{ $programa->nombre }}"
                class="inline-flex h-8 w-8 items-center justify-center
                       rounded-md border transition
                       {{ $programa->estado === 'Activo'
                           ? 'border-red-200 bg-red-50 text-red-700 hover:bg-red-100'
                           : 'border-green-200 bg-green-50 text-green-700 hover:bg-green-100' }}">

                <i class="bi {{ $programa->estado === 'Activo'
                    ? 'bi-toggle-off'
                    : 'bi-toggle-on' }}"
                   aria-hidden="true"></i>

            </button>

        </form>

    @endif

</div>