@php
    $esSeguimiento = in_array($tipo, ['avances', 'presupuestos'], true);

    $claseCampo = 'mt-1 w-full rounded-md border border-gray-300 px-3 py-2
                   text-sm font-normal text-gray-700
                   focus:border-blue-500 focus:ring-blue-500';
@endphp


<form method="GET"
      action="{{ route('reportes.index') }}"
      class="space-y-4">

    <!-- Campos -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

        <!-- Tipo de reporte -->
        <div>

            <label for="tipoReporte"
                   class="block text-sm font-medium text-gray-700">
                Reporte
            </label>

            <select id="tipoReporte"
                    name="tipo"
                    onchange="this.form.requestSubmit()"
                    class="{{ $claseCampo }}">

                @foreach($tipos as $clave => $nombre)

                    <option value="{{ $clave }}" @selected($tipo === $clave)>
                        {{ $nombre }}
                    </option>

                @endforeach

            </select>

            <x-input-error :messages="$errors->get('tipo')" class="mt-1" />

        </div>


        <!-- Año -->
        <div>

            <label for="anioReporte"
                   class="block text-sm font-medium text-gray-700">
                Año
            </label>

            <input id="anioReporte"
                   name="anio"
                   type="number"
                   min="2000"
                   max="2100"
                   value="{{ $filtros['anio'] ?? '' }}"
                   placeholder="Todos"
                   class="{{ $claseCampo }}">

            <x-input-error :messages="$errors->get('anio')" class="mt-1" />

        </div>


        @if($esSeguimiento)

            <!-- Período -->
            <div>

                <label for="periodoReporte"
                       class="block text-sm font-medium text-gray-700">
                    Período
                </label>

                <select id="periodoReporte"
                        name="periodo"
                        class="{{ $claseCampo }}">

                    <option value="">Todos los períodos</option>

                    @foreach($periodos as $periodo)

                        <option value="{{ $periodo }}"
                            @selected(($filtros['periodo'] ?? '') === $periodo)>
                            {{ $periodo }}
                        </option>

                    @endforeach

                </select>

                <x-input-error :messages="$errors->get('periodo')" class="mt-1" />

            </div>


            <!-- Proyecto -->
            <div>

                <label for="proyectoReporte"
                       class="block text-sm font-medium text-gray-700">
                    Proyecto
                </label>

                <select id="proyectoReporte"
                        name="proyecto_id"
                        class="{{ $claseCampo }}">

                    <option value="">Todos los proyectos</option>

                    @foreach($proyectos as $proyecto)

                        <option value="{{ $proyecto->id }}"
                            @selected(
                                (string) ($filtros['proyecto_id'] ?? '')
                                === (string) $proyecto->id
                            )>

                            {{ $proyecto->codigo }} - {{ $proyecto->nombre }}

                        </option>

                    @endforeach

                </select>

                <x-input-error :messages="$errors->get('proyecto_id')" class="mt-1" />

            </div>

        @endif

    </div>


    <!-- Acciones de los filtros 
    <div class="flex flex-wrap items-center gap-2">

        <button type="submit"
                class="inline-flex items-center gap-2 rounded-md bg-blue-600
                       px-4 py-2 text-sm font-medium text-white
                       transition hover:bg-blue-700">

            <i class="bi bi-search" aria-hidden="true"></i>
            Consultar

        </button>


        <a href="{{ route('reportes.index', ['tipo' => $tipo]) }}"
           class="inline-flex items-center gap-2 rounded-md border border-gray-300
                  px-4 py-2 text-sm font-medium text-gray-700
                  transition hover:bg-gray-50">

            <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
            Limpiar filtros

        </a>

    </div> -->

</form>