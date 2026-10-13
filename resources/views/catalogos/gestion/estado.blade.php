@if(puedeHacer($modulo, 'estado'))
    <form class="inline" method="POST" action="{{ route('catalogos.gestion.estado', [$recursoEstado, $registroEstado->id]) }}">
        @csrf @method('PUT')
        <input type="hidden" name="estado" value="{{ $registroEstado->estado === 'Activo' ? 'Inactivo' : 'Activo' }}">
        <button type="submit" class="text-sm {{ $registroEstado->estado === 'Activo' ? 'text-red-600 hover:text-red-800' : 'text-green-700 hover:text-green-900' }}">
            {{ $registroEstado->estado === 'Activo' ? 'Desactivar' : 'Activar' }}
        </button>
    </form>
@endif
