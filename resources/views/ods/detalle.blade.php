<x-catalogos-layout title="Detalle ODS">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300">

        <div class="flex">

            <a href="{{ route('ods.index') }}"
               class="py-2 text-sm font-medium text-blue-500
                      hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

            <a href="{{ url()->current() }}"
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-arrow-clockwise text-blue-500 me-2"></i>
                Actualizar

            </a>

        </div>

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
         style="height: calc(100vh - 180px);">


        <!-- Información del ODS -->
        <div class="bg-white p-6 shadow-sm">


            <!-- Cabecera ODS + Imagen -->
            <div class="flex items-center gap-4 pb-6">

                <!-- Imagen -->
                <div class="w-20 h-20 flex-shrink-0">

                    @if(isset($imagenesOds[$ods->id]))

                        <img
                            src="{{ asset(
                                'images/ods/' .
                                $imagenesOds[$ods->id]
                            ) }}"
                            alt="{{ $ods->nombre }}"
                            class="w-full h-full object-cover">

                    @else

                        <div class="w-full h-full
                                    bg-gray-100
                                    border border-gray-200
                                    flex items-center justify-center">

                            <i class="bi bi-image text-gray-400 text-2xl"></i>

                        </div>

                    @endif

                </div>


                <!-- Información -->
                <div>

                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $ods->nombre }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $ods->codigo }}
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $ods->metas->count() }} metas
                    </p>

                </div>

            </div>


            <!-- Accordion de metas -->
            <div class="border border-gray-200 rounded-md overflow-hidden">

                @forelse($ods->metas as $meta)

                    <!-- Meta -->
                    <div
                        x-data="{ abierto: false }"
                        class="border-b border-gray-200 last:border-b-0">


                        <!-- Encabezado -->
                        <button
                            type="button"
                            @click="abierto = !abierto"
                            class="w-full flex items-center justify-between
                                   px-4 py-3
                                   text-left
                                   transition"
                            :class="abierto
                                ? 'bg-blue-50'
                                : 'bg-gray-50 hover:bg-gray-100'">


                            <!-- Código + nombre -->
                            <div class="flex items-center gap-4 min-w-0">

                                <span
                                    class="w-14 flex-shrink-0
                                           text-sm font-semibold"
                                    :class="abierto
                                        ? 'text-blue-600'
                                        : 'text-gray-700'">

                                    {{ $meta->codigo }}

                                </span>

                                <span
                                    class="text-sm font-medium"
                                    :class="abierto
                                        ? 'text-blue-700'
                                        : 'text-gray-800'">

                                    {{ $meta->nombre }}

                                </span>

                            </div>


                            <!-- Flecha -->
                            <div class="ml-4 flex-shrink-0">

                                <i
                                    class="bi bi-chevron-down
                                           transition-transform
                                           duration-200"
                                    :class="abierto
                                        ? 'rotate-180 text-blue-600'
                                        : 'text-gray-500'">
                                </i>

                            </div>

                        </button>


                        <!-- Descripción -->
                        <div
                            x-show="abierto"
                            x-transition
                            x-cloak
                            class="bg-gray-50 px-4 pb-4 pt-2">

                            <p class="text-sm text-gray-600 leading-relaxed">

                                {{ $meta->descripcion
                                    ?: 'No existe una descripción registrada para esta meta.' }}

                            </p>

                        </div>

                    </div>

                @empty

                    <div class="py-8 text-center text-sm text-gray-500">

                        No existen metas registradas para este ODS.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-catalogos-layout>