@if($definicion['modulo'] === 'ods')
    <nav aria-label="Navegación de ODS" class="flex flex-wrap items-center gap-4 py-3 mb-4 border-b border-gray-200 text-sm">
        <a class="text-blue-600" href="{{ route('ods.index') }}">Agendas ODS</a>
        @if($recurso === 'ods' && $padreSeleccionado)<a class="text-blue-600" href="{{ route('ods.agenda', $padreSeleccionado->id) }}">{{ $padreSeleccionado->nombre }}</a>@endif
        @if($recurso === 'ods-metas' && $padreSeleccionado)
            <a class="text-blue-600" href="{{ route('ods.agenda', $padreSeleccionado->agenda_id) }}">{{ $padreSeleccionado->agenda->nombre }}</a>
            <a class="text-blue-600" href="{{ route('ods.detalle', $padreSeleccionado->id) }}">{{ $padreSeleccionado->codigo }} · {{ $padreSeleccionado->nombre }}</a>
        @endif
    </nav>
@else
<nav aria-label="Gestión de catálogos" class="flex flex-wrap gap-3 py-3 mb-4 border-b border-gray-200">
    @foreach(config('catalogos') as $clave => $catalogo)
        @if($catalogo['modulo'] === $definicion['modulo'])
            <a href="{{ route('catalogos.gestion.index', $clave) }}"
               class="text-sm {{ $clave === $recurso ? 'font-semibold text-blue-700' : 'text-gray-600 hover:text-blue-700' }}">
                {{ $catalogo['titulo'] }}
            </a>
        @endif
    @endforeach
    <a class="text-sm text-blue-600 ml-auto" href="{{ route($definicion['modulo'] === 'clasificacion_inversion' ? 'clasificacion-inversion.index' : $definicion['modulo'].'.index') }}">Ver catálogo</a>
</nav>
@endif
@if(session('success'))
    <div role="status" class="mb-4 p-3 bg-green-50 text-green-800 rounded-md">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div role="alert" class="mb-4 p-3 bg-red-50 text-red-800 rounded-md">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
