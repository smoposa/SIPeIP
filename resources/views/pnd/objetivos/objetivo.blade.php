<x-catalogos-layout :title="'Objetivo Nacional ' . $objetivo->numero">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs">

                <li>

                    <a href="{{ route('pnd.index') }}"
                       class="text-blue-600 hover:text-blue-800 hover:underline">

                        Planes nacionales

                    </a>

                </li>


                <li aria-hidden="true">
                    <i class="bi bi-chevron-right"></i>
                </li>


                <li>

                    <a href="{{ route('pnd.ejes.index', ['pnd' => $objetivo->eje->pnd_id]) }}"
                       class="text-blue-600 hover:text-blue-800 hover:underline">

                        {{ $objetivo->eje->pnd->nombre }}

                    </a>

                </li>


                <li aria-hidden="true">
                    <i class="bi bi-chevron-right"></i>
                </li>


                <li>

                    <a href="{{ route('pnd.objetivos.index', ['eje' => $objetivo->pnd_eje_id]) }}"
                       class="text-blue-600 hover:text-blue-800 hover:underline">

                        Eje {{ $objetivo->eje->numero }} · {{ $objetivo->eje->nombre }}

                    </a>

                </li>


                <li aria-hidden="true">
                    <i class="bi bi-chevron-right"></i>
                </li>


                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Objetivo {{ $objetivo->numero }}

                </li>

            </ol>

        </nav>

    </x-slot>


    <div id="detalleObjetivoPnd" class="space-y-4">

        <!-- Notificaciones -->
        @include('pnd.partials.avisos')


        <!-- Barra de acciones -->
        <div class="bg-white border-b border-gray-300 mb-0">

            <div class="flex items-stretch overflow-x-auto">

                <!-- Regresar -->
                <a href="{{ route('pnd.objetivos.index', ['eje' => $objetivo->pnd_eje_id]) }}"
                   class="shrink-0 py-2 text-sm font-medium text-blue-500
                          hover:text-blue-800 mr-8 whitespace-nowrap">

                    <i class="bi bi-chevron-left" aria-hidden="true"></i>
                    Regresar

                </a>


                <!-- Pestañas -->
                <div
                    role="tablist"
                    aria-label="Contenido del objetivo nacional"
                    class="flex shrink-0">

                    <!-- Políticas y estrategias -->
                    <button
                        type="button"
                        id="tabPoliticasPnd"
                        role="tab"
                        aria-selected="true"
                        aria-controls="contenidoPoliticasPnd"
                        data-pestana-pnd
                        class="px-3 py-2 text-sm text-blue-700 bg-gray-100
                               hover:bg-gray-100 transition whitespace-nowrap
                               focus-visible:outline focus-visible:outline-2
                               focus-visible:outline-blue-500">

                        <i class="bi bi-list-check text-blue-500 me-2" aria-hidden="true"></i>
                        Políticas y estrategias

                    </button>


                    <!-- Metas -->
                    <button
                        type="button"
                        id="tabMetasPnd"
                        role="tab"
                        aria-selected="false"
                        aria-controls="contenidoMetasPnd"
                        tabindex="-1"
                        data-pestana-pnd
                        class="px-3 py-2 text-sm text-gray-700
                               hover:bg-gray-100 transition whitespace-nowrap
                               focus-visible:outline focus-visible:outline-2
                               focus-visible:outline-blue-500">

                        <i class="bi bi-flag text-blue-500 me-2" aria-hidden="true"></i>
                        Metas

                    </button>

                </div>


                <!-- Actualizar -->
                <a href="{{ url()->current() }}"
                   class="shrink-0 px-3 py-2 text-sm text-gray-700
                          hover:bg-gray-100 transition whitespace-nowrap">

                    <i class="bi bi-arrow-clockwise text-blue-500 me-2" aria-hidden="true"></i>
                    Actualizar

                </a>

            </div>

        </div>


        <!-- Pestañas, buscador y listados -->
        <div class="space-y-4">

            <!-- Buscador, resumen y acciones -->
            <div class="flex flex-wrap items-center gap-4">

                <!-- Buscador -->
                <div class="relative flex-1 max-w-md">

                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">

                        <i class="bi bi-search" aria-hidden="true"></i>

                    </span>

                    <input
                        type="text"
                        id="buscarContenidoObjetivoPnd"
                        placeholder="Buscar política o estrategia..."
                        aria-label="Buscar política o estrategia"
                        class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                               focus:ring-blue-500 focus:border-blue-500">

                </div>


                <!-- Resumen general -->
                <div class="flex-1">

                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-gray-500">

                        <!-- Políticas -->
                        <span class="inline-flex items-center gap-2">

                            <i class="bi bi-list-check text-blue-500" aria-hidden="true"></i>

                            <span>

                                <strong class="font-semibold text-gray-700">
                                    {{ $objetivo->politicas->count() }}
                                </strong>
                                políticas

                            </span>

                        </span>


                        <!-- Estrategias -->
                        <span class="inline-flex items-center gap-2">

                            <i class="bi bi-signpost-split text-blue-500" aria-hidden="true"></i>

                            <span>

                                <strong class="font-semibold text-gray-700">
                                    {{ $objetivo->politicas->sum(fn ($politica) => $politica->estrategias->count()) }}
                                </strong>
                                estrategias

                            </span>

                        </span>


                        <!-- Metas -->
                        <span class="inline-flex items-center gap-2">

                            <i class="bi bi-flag text-blue-500" aria-hidden="true"></i>

                            <span>

                                <strong class="font-semibold text-gray-700">
                                    {{ $objetivo->metas->count() }}
                                </strong>
                                metas

                            </span>

                        </span>

                    </div>

                </div>


                <!-- Acciones de registro -->
                @if(puedeHacer('pnd', 'crear'))

                    <!-- Registrar política -->
                    <button
                        type="button"
                        id="registrarPoliticaPnd"
                        aria-haspopup="dialog"
                        aria-controls="panelRegistroPnd"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                               text-white text-sm font-medium px-4 py-2 rounded-md
                               whitespace-nowrap disabled:opacity-50
                               disabled:cursor-not-allowed">

                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                        Registrar política

                    </button>


                    <!-- Registrar meta -->
                    <button
                        type="button"
                        id="registrarMetaPnd"
                        hidden
                        aria-haspopup="dialog"
                        aria-controls="panelRegistroPnd"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                               text-white text-sm font-medium px-4 py-2 rounded-md
                               whitespace-nowrap disabled:opacity-50
                               disabled:cursor-not-allowed">

                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                        Registrar meta

                    </button>

                @endif

            </div>


            <!-- Políticas y estrategias -->
            <div
                id="contenidoPoliticasPnd"
                role="tabpanel"
                aria-labelledby="tabPoliticasPnd"
                tabindex="0"
                data-contenido-pnd>

                @include('pnd.objetivos.partials.politicas-estrategias')

            </div>


            <!-- Metas -->
            <div
                id="contenidoMetasPnd"
                role="tabpanel"
                aria-labelledby="tabMetasPnd"
                tabindex="0"
                data-contenido-pnd
                hidden>

                @include('pnd.objetivos.partials.listado-metas')

            </div>

        </div>


        <!-- Panel reutilizable de políticas, estrategias y metas -->
        @include('pnd.objetivos.partials.panel-registro-pnd')


        <!-- Funcionamiento de pestañas y buscador -->
        @include('pnd.objetivos.partials.scripts-detalle')

        <!-- Registro, consulta y edición -->
        @include('pnd.objetivos.partials.scripts-panel-registro-pnd')

    </div>

</x-catalogos-layout>
