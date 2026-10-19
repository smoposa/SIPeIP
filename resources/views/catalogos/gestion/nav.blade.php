@if($definicion['modulo'] === 'ods')

    <nav
        aria-label="Navegación de ODS"
        class="flex flex-wrap items-center gap-4 py-3 mb-4
               border-b border-gray-200 text-sm">

        <a href="{{ route('ods.agendas.index') }}"
           class="text-blue-600 hover:text-blue-800 hover:underline">

            Agendas ODS

        </a>

        @if($recurso === 'ods' && $padreSeleccionado)

            <a href="{{ route('ods.objetivos.index', [
                    'agenda' => $padreSeleccionado->id,
                ]) }}"
               class="text-blue-600 hover:text-blue-800 hover:underline">

                {{ $padreSeleccionado->nombre }}

            </a>

        @endif

        @if($recurso === 'ods-metas' && $padreSeleccionado)

            <a href="{{ route('ods.objetivos.index', [
                    'agenda' => $padreSeleccionado->agenda_id,
                ]) }}"
               class="text-blue-600 hover:text-blue-800 hover:underline">

                {{ $padreSeleccionado->agenda->nombre }}

            </a>

            <a href="{{ route('ods.metas.index', [
                    'ods' => $padreSeleccionado->id,
                ]) }}"
               class="text-blue-600 hover:text-blue-800 hover:underline">

                {{ $padreSeleccionado->codigo }} · {{ $padreSeleccionado->nombre }}

            </a>

        @endif

    </nav>

@else

    <nav
        aria-label="Gestión de catálogos"
        class="flex flex-wrap gap-3 py-3 mb-4 border-b border-gray-200">

        @foreach(config('catalogos') as $clave => $catalogo)

            @if($catalogo['modulo'] === $definicion['modulo'])

                <a href="{{ route('catalogos.gestion.index', $clave) }}"
                   class="text-sm {{ $clave === $recurso
                       ? 'font-semibold text-blue-700'
                       : 'text-gray-600 hover:text-blue-700' }}">

                    {{ $catalogo['titulo'] }}

                </a>

            @endif

        @endforeach

        <a href="{{ route(
                $definicion['modulo'] === 'clasificacion_inversion'
                    ? 'clasificacion-inversion.index'
                    : $definicion['modulo'] . '.index'
            ) }}"
           class="text-sm text-blue-600 hover:text-blue-800
                  hover:underline ml-auto">

            Ver catálogo

        </a>

    </nav>

@endif


@if(session('success'))

    <div role="status"
         class="mb-4 p-3 bg-green-50 text-green-800 rounded-md">

        {{ session('success') }}

    </div>

@endif


@if($errors->any())

    <div role="alert"
         class="mb-4 p-3 bg-red-50 text-red-800 rounded-md">

        <ul>

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif