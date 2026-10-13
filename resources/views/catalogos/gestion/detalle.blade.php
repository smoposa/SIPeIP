<x-catalogos-layout :title="$definicion['titulo']">
    @include('catalogos.gestion.nav')
    <div class="max-w-3xl p-6 bg-white rounded-lg border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Detalle del registro</h2>
        <dl class="space-y-4">
            @if($padre)
                @php($superior = $opciones->firstWhere('id', $registro->{$definicion['padre']['campo']}))
                <div><dt class="text-sm font-semibold text-gray-600">Pertenece a</dt><dd class="text-sm text-gray-800">{{ $superior?->codigo ?? $superior?->numero }} {{ $superior?->nombre ?? $superior?->descripcion }}</dd></div>
            @endif
            @foreach($definicion['campos'] as $campo => $configuracion)
                <div><dt class="text-sm font-semibold text-gray-600">{{ $configuracion['etiqueta'] }}</dt><dd class="text-sm text-gray-800 whitespace-pre-line">{{ $registro->$campo ?? 'Sin información' }}</dd></div>
            @endforeach
        </dl>
        <div class="flex gap-4 mt-6 text-sm">
            <a class="text-blue-600" href="{{ $retorno }}">Regresar</a>
            @if(puedeHacer($definicion['modulo'], 'editar'))<a class="text-blue-600" href="{{ route('catalogos.gestion.edit', [$recurso, $registro->id]) }}">Editar</a>@endif
            @if($recurso === 'pnd')<a class="text-blue-600" href="{{ route('pnd.index', ['plan' => $registro->id]) }}">Ver estructura del plan</a>@endif
        </div>
    </div>
</x-catalogos-layout>
