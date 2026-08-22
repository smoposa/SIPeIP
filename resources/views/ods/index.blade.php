<x-catalogos-layout title="ODS">

    <!-- Encabezado -->
    <div class="mb-4">

        <h2 class="text-2xl font-semibold text-gray-800">
            17 Objetivos de Desarrollo para transformar el mundo
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            El 25 de septiembre de 2015 la Asamblea General de Naciones Unidas aprobó, por unanimidad, la Agenda 2030 para el Desarrollo Sostenible: un plan de acción en favor de las personas, el planeta, la prosperidad y la paz universal. Cuenta con 17 Objetivos de Desarrollo Sostenible (ODS) y 169 metas concretas a desarrollar con horizonte 2030.
        </p>

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
         style="height: calc(100vh - 200px);">

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

    @if(isset($imagenesOds[$item->id]))

        <img
            src="{{ asset(
                'images/ods/' .
                $imagenesOds[$item->id]
            ) }}"
            alt="ODS {{ $item->id }} - {{ $item->nombre }}"
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