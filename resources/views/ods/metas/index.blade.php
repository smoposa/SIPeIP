<x-catalogos-layout :title="'Metas  ' . $ods->codigo">

    <!-- Migas de pan del encabezado -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs">

                <li>

                    <a href="{{ route('ods.agendas.index') }}"
                       class="text-blue-600 hover:text-blue-800 hover:underline">

                        Agendas ODS

                    </a>

                </li>


                <li aria-hidden="true">

                    <i class="bi bi-chevron-right"></i>

                </li>


                <li class="break-words">
                    {{ $ods->agenda?->nombre ?? 'Agenda' }}
                </li>


                <li aria-hidden="true">

                    <i class="bi bi-chevron-right"></i>

                </li>


                <li>

                    <a href="{{ route('ods.objetivos.index', ['agenda' => $ods->agenda_id]) }}"
                       class="text-blue-600 hover:text-blue-800 hover:underline">

                        Objetivos

                    </a>

                </li>


                <li aria-hidden="true">

                    <i class="bi bi-chevron-right"></i>

                </li>


                <li>
                    {{ $ods->codigo }}
                </li>


                <li aria-hidden="true">

                    <i class="bi bi-chevron-right"></i>

                </li>


                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Metas

                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('ods.partials.avisos')


        <!-- Barra de acciones -->
        <div class="bg-white border-b border-gray-300 mb-0">

            <div class="flex">

                <a href="{{ route('ods.objetivos.index', ['agenda' => $ods->agenda_id]) }}"
                   class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                    <i class="bi bi-chevron-left" aria-hidden="true"></i>
                    Regresar

                </a>


                <a href="{{ url()->current() }}"
                   class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                    <i class="bi bi-arrow-clockwise text-blue-500 me-2" aria-hidden="true"></i>
                    Actualizar

                </a>

            </div>

        </div>


        <!-- Scroll vertical -->
        <div class="overflow-y-auto"
             style="height: calc(100vh - 180px);">

            <div class="bg-white p-6 shadow-sm">

                <!-- Cabecera del objetivo -->
                <div class="flex items-center gap-4 mb-0 pb-6">

                    <!-- Relación entre códigos e imágenes -->
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

                        $numeroOds = (int) str_replace('ODS-', '', $ods->codigo);
                        $imagenOds = $imagenesOds[$numeroOds] ?? null;

                    @endphp


                    <!-- Imagen del objetivo -->
                    <div class="w-24 h-24 shrink-0 overflow-hidden">

                        @if($imagenOds)

                            <img
                                src="{{ asset('images/ods/' . $imagenOds) }}"
                                alt="{{ $ods->codigo }} - {{ $ods->nombre }}"
                                class="w-full h-full object-contain">

                        @else

                            <div class="w-full h-full flex items-center justify-center
                                        bg-gray-100 text-xs text-gray-500 text-center">

                                Imagen no disponible

                            </div>

                        @endif

                    </div>


                    <!-- Información del objetivo y acción -->
                    <div class="min-w-0 flex-1 flex flex-col md:flex-row md:items-start gap-4">

                        <!-- Información del objetivo -->
                        <div class="min-w-0 flex-1">

                            <!-- Nombre -->
                            <h2 class="text-xl font-semibold text-gray-800 break-words">
                                {{ $ods->nombre }}
                            </h2>


                            <!-- Código y total de metas -->
                            <div class="flex flex-wrap items-center gap-4 mb-1">

                                <span class="text-sm font-medium text-[#024687]">
                                    {{ $ods->codigo }}
                                </span>

                                <span class="text-sm text-gray-500">
                                    {{ $ods->metas->count() }} metas
                                </span>

                            </div>


                            <!-- Descripción -->
                            <p class="mt-2 text-sm text-gray-600 leading-relaxed whitespace-pre-line break-words">{{ $ods->descripcion ?: 'Sin descripción registrada.' }}</p>

                        </div>


                        <!-- Registrar meta -->
                        @if(puedeHacer('ods', 'crear'))

                            <div class="shrink-0">

                                <button
                                    type="button"
                                    id="registrarMeta"
                                    aria-haspopup="dialog"
                                    aria-controls="panelMeta"
                                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                                           text-white text-sm font-medium px-4 py-2 rounded-md
                                           transition whitespace-nowrap">

                                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                                    Registrar meta

                                </button>

                            </div>

                        @endif

                    </div>

                </div>


                <!-- Listado y panel de metas -->
                <div id="gestionMetas">

                    @include('ods.metas.partials.listado-metas')

                    @include('ods.metas.partials.panel-editar-meta')

                </div>


                <!-- Funcionamiento del panel lateral -->
                @include('ods.metas.partials.scripts-metas')

            </div>

        </div>

    </div>

</x-catalogos-layout>