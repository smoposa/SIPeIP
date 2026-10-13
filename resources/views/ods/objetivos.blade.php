<x-catalogos-layout :title="$agenda->nombre">
    @include('ods.partials.avisos')
    <div class="flex flex-wrap items-center gap-4 py-3 border-b border-gray-200 mb-4">
        <a href="{{ route('ods.index') }}" class="text-sm text-blue-600"><i class="bi bi-chevron-left"></i> Agendas ODS</a>
        @if(puedeHacer('ods', 'crear'))
            <a href="{{ route('catalogos.gestion.create', ['recurso' => 'ods', 'padre' => $agenda->id]) }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">Crear objetivo ODS</a>
        @endif
        @if(puedeHacer('ods', 'editar'))<a class="text-sm text-blue-600" href="{{ route('catalogos.gestion.edit', ['ods-agendas', $agenda->id]) }}">Editar agenda</a>@endif
        @include('catalogos.gestion.estado', ['modulo' => 'ods', 'recursoEstado' => 'ods-agendas', 'registroEstado' => $agenda])
    </div>
    <div class="mb-5">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $agenda->nombre }}</h2>
        <p class="text-sm text-gray-500 mt-1">{{ $agenda->periodo_inicio }}–{{ $agenda->periodo_fin }} · {{ $ods->count() }} objetivos · {{ $agenda->estado }}</p>
        @if($agenda->descripcion)<p class="text-sm text-gray-600 mt-2">{{ $agenda->descripcion }}</p>@endif
        @if($agenda->estado === 'Inactivo')<p class="mt-2 text-sm text-amber-700">Agenda inactiva. Su información se conserva para consulta y no se utiliza en nuevas alineaciones.</p>@endif
    </div>
    <!-- Relación entre ODS e imágenes -->
    @php

        $imagenesOds = [
            1  => '1-fin-de-la-pobreza-11.jpg',
            2  => '2-hambre-cero-20.jpg',
            3  => '3-salud-y-bienestar-3.jpg',
            4  => '4-educacion-de-calidad-3.jpg',
            5  => '5-igualdad-de-genero-3.jpg',
            6  => '6-agua-limpia-y-saneamiento-3.jpg',
            7  => '7-energia-asequible-y-no-contaminante-3.jpg',
            8  => '8-trabajo-decente-y-crecimiento-economico-3.jpg',
            9  => '9-industria-innovacion-e-infraestructura-3.jpg',
            10 => '10-reduccion-de-las-desigualdades-3.jpg',
            11 => '11-ciudades-y-comunidades-sostenibles-3.jpg',
            12 => '12-produccion-y-consumo-responsables-3.jpg',
            13 => '13-accion-por-el-clima-3.jpg',
            14 => '14-vida-submarina-3.jpg',
            15 => '15-vida-de-ecosistemas-terrestres-3.jpg',
            16 => '16-paz-justicia-e-instituciones-solidas-3.jpg',
            17 => '17-alianzas-para-lograr-los-objetivos-3.jpg',
        ];

    @endphp


    <!-- Scroll vertical -->
    <div class="overflow-y-auto"
         style="max-height: calc(100vh - 320px);">

        <!-- Grid ODS -->
        <div class="grid grid-cols-2
                    sm:grid-cols-3
                    md:grid-cols-4
                    xl:grid-cols-8
                    gap-4
                    pb-6">

            @forelse($ods as $item)

                <div class="group">

<!-- Imagen ODS -->
<a href="{{ route('ods.detalle', $item->id) }}"
   class="block overflow-hidden
          border border-gray-200
          bg-white
          transition duration-200
          hover:shadow-md
          cursor-pointer">

    @if(isset($imagenesOds[(int) str_replace('ODS-', '', $item->codigo)]))

        <img
            src="{{ asset(
                'images/ods/' .
                $imagenesOds[(int) str_replace('ODS-', '', $item->codigo)]
            ) }}"
            alt="{{ $item->codigo }} - {{ $item->nombre }}"
            class="w-full h-auto object-cover
                   transition duration-200
                   hover:opacity-90">

    @else

        <div class="flex items-center justify-center
                    h-40 bg-gray-100
                    text-sm text-gray-400">

            Imagen no disponible

        </div>

    @endif

</a>

                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $item->codigo }} · {{ $item->nombre }}</p>
                    <p class="mt-1 text-xs text-gray-500">{{ $item->metas_count }} metas · {{ $item->estado }}</p>
                    <div class="flex flex-wrap gap-3 mt-2 text-sm">
                        @if(puedeHacer('ods', 'editar'))
                            <a class="text-blue-600" href="{{ route('catalogos.gestion.edit', ['ods', $item->id]) }}">Editar</a>
                        @endif
                        @include('catalogos.gestion.estado', ['modulo' => 'ods', 'recursoEstado' => 'ods', 'registroEstado' => $item])
                    </div>
                </div>

            @empty

                <div class="col-span-full
                            py-10
                            text-center
                            text-sm
                            text-gray-500">

                    No existen Objetivos de Desarrollo Sostenible registrados.

                </div>

            @endforelse

        </div>

    </div>

</x-catalogos-layout>