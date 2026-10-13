<x-catalogos-layout :title="$definicion['titulo']">
    @include('catalogos.gestion.nav')
    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $registro ? 'Editar' : 'Crear' }} · {{ $definicion['titulo'] }}</h2>
    <form method="POST" action="{{ $registro ? route('catalogos.gestion.update', [$recurso, $registro->id]) : route('catalogos.gestion.store', $recurso) }}" class="max-w-3xl bg-white p-6 border border-gray-200 rounded-lg space-y-5">
        @csrf
        @if($registro) @method('PUT') @endif
        @if($padre)
            @php
                $campoPadre = $definicion['padre']['campo'];
            @endphp
            <div>
                <label for="{{ $campoPadre }}" class="block text-sm font-medium text-gray-700 mb-1">Pertenece a: {{ $padre['titulo'] }} *</label>
                @if(($definicion['padre_inmutable'] ?? false) && $padreSeleccionado)
                    <input type="hidden" name="{{ $campoPadre }}" value="{{ $padreSeleccionado->id }}">
                    <p class="text-sm text-gray-800 p-3 bg-gray-50 border border-gray-200 rounded-md">{{ $padreSeleccionado->codigo }} {{ $padreSeleccionado->nombre }}</p>
                @else
                <select id="{{ $campoPadre }}" name="{{ $campoPadre }}" required class="w-full rounded-md border-gray-300 text-sm">
                    <option value="">Seleccione un registro</option>
                    @foreach($opciones as $opcion)
                        <option value="{{ $opcion->id }}" @selected((string) old($campoPadre, $registro?->$campoPadre ?? $padreSeleccionado?->id) === (string) $opcion->id)>
                            #{{ $opcion->id }} · {{ $opcion->codigo ?? $opcion->numero }} {{ $opcion->nombre ?? $opcion->descripcion }}
                        </option>
                    @endforeach
                </select>
                @endif
                @error($campoPadre)<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                @if($opciones->isEmpty())<p class="text-sm text-gray-500 mt-2">Cree primero un registro en {{ $padre['titulo'] }}.</p>@endif
            </div>
        @endif
        @foreach($definicion['campos'] as $campo => $configuracion)
            @if($campo === 'estado')
                <input type="hidden" name="estado" value="{{ $registro?->estado ?? 'Activo' }}">
            @else
            @php
                $valor = old($campo, $registro?->$campo ?? ($campo === 'estado' ? 'Activo' : ''));
                $requerido = str_starts_with($configuracion['reglas'], 'required');
            @endphp
            <div>
                <label for="{{ $campo }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $configuracion['etiqueta'] }} {{ $requerido ? '*' : '' }}</label>
                @if($configuracion['tipo'] === 'textarea')
                    <textarea id="{{ $campo }}" name="{{ $campo }}" rows="4" @required($requerido) class="w-full rounded-md border-gray-300 text-sm">{{ $valor }}</textarea>
                @elseif($configuracion['tipo'] === 'select')
                    <select id="{{ $campo }}" name="{{ $campo }}" required class="w-full rounded-md border-gray-300 text-sm">
                        @foreach(['Activo', 'Inactivo'] as $estado)<option @selected($valor === $estado)>{{ $estado }}</option>@endforeach
                    </select>
                @else
                    <input id="{{ $campo }}" name="{{ $campo }}" type="{{ $configuracion['tipo'] }}" value="{{ $valor }}" @required($requerido) class="w-full rounded-md border-gray-300 text-sm">
                @endif
                @error($campo)<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            @endif
        @endforeach
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">{{ $registro ? 'Guardar cambios' : 'Crear registro' }}</button>
            <a href="{{ $retorno }}" class="text-sm text-gray-600">Cancelar</a>
        </div>
    </form>
</x-catalogos-layout>
