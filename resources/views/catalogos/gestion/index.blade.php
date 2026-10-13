<x-catalogos-layout :title="$definicion['titulo']">
    @include('catalogos.gestion.nav')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">{{ $definicion['titulo'] }} <span class="text-sm text-gray-500">({{ $registros->total() }})</span></h2>
        @if(puedeHacer($definicion['modulo'], 'crear'))
            <a href="{{ route('catalogos.gestion.create', $recurso) }}" class="rounded-md bg-blue-600 px-4 py-2 text-white text-sm hover:bg-blue-700">Crear registro</a>
        @endif
    </div>
    <div class="bg-white border border-gray-200 rounded-lg overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600"><tr>
                <th class="p-3">Código / número</th><th class="p-3">Nombre / descripción</th>
                @if($padre)<th class="p-3">Pertenece a</th>@endif
                @if(isset($definicion['campos']['estado']))<th class="p-3">Estado</th>@endif
                <th class="p-3">Acciones</th>
            </tr></thead>
            <tbody>
            @forelse($registros as $item)
                <tr class="border-t border-gray-200">
                    <td class="p-3">{{ $item->codigo ?? $item->numero ?? '—' }}</td>
                    <td class="p-3">{{ $item->nombre ?? $item->descripcion }}</td>
                    @if($padre)
                        @php($superior = $opciones->firstWhere('id', $item->{$definicion['padre']['campo']}))
                        <td class="p-3">{{ $superior?->codigo ?? $superior?->numero }} {{ $superior?->nombre ?? $superior?->descripcion }}</td>
                    @endif
                    @if(isset($definicion['campos']['estado']))<td class="p-3">{{ $item->estado }}</td>@endif
                    <td class="p-3 whitespace-nowrap">
                        <a class="text-blue-600 mr-3" href="{{ route('catalogos.gestion.show', [$recurso, $item->id]) }}">Detalle</a>
                        @if(puedeHacer($definicion['modulo'], 'editar'))
                            <a class="text-blue-600 mr-3" href="{{ route('catalogos.gestion.edit', [$recurso, $item->id]) }}">Editar</a>
                        @endif
                        @include('catalogos.gestion.estado', ['modulo' => $definicion['modulo'], 'recursoEstado' => $recurso, 'registroEstado' => $item])
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-6 text-center text-gray-500">No existen registros.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $registros->links() }}</div>
</x-catalogos-layout>
