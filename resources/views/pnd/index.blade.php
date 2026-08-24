<x-catalogos-layout title="PND">

    <!-- =========================================================
         INFORMACIÓN GENERAL DEL PND
    ========================================================== -->
    @if($pnd)

        <div class="bg-white border border-gray-200 rounded-lg mb-5">

            <div class="px-5 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                <!-- Información -->
                <div class="min-w-0">

                    <div class="flex items-center gap-3">

                        <!-- Identificador -->
                        <div class="w-11 h-11 rounded-lg bg-gray-100 border border-gray-200
                                    flex items-center justify-center flex-shrink-0">

                            <i class="bi bi-journal-text text-xl text-gray-600"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Plan Nacional de Desarrollo
                            </p>

                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $pnd->nombre }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                Período {{ $pnd->periodo_inicio }} - {{ $pnd->periodo_fin }}
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Estado -->
                <div class="flex items-center">

                    @if($pnd->estado === 'Activo')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5
                                     rounded-full bg-green-50 text-green-700
                                     border border-green-200 text-xs font-medium">

                            <span class="w-2 h-2 rounded-full bg-green-500"></span>

                            Activo

                        </span>

                    @else

                        <span class="inline-flex items-center gap-2 px-3 py-1.5
                                     rounded-full bg-red-50 text-red-700
                                     border border-red-200 text-xs font-medium">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Inactivo

                        </span>

                    @endif

                </div>

            </div>

        </div>

    @endif


    <!-- =========================================================
         RESUMEN GENERAL
    ========================================================== -->
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-3 mb-5">

        <!-- Ejes -->
        <div class="bg-white border border-gray-200 rounded-lg px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-slate-100
                            flex items-center justify-center flex-shrink-0">

                    <i class="bi bi-diagram-3 text-slate-600"></i>

                </div>

                <div>

                    <p class="text-xl font-semibold text-gray-800">
                        {{ $resumen['ejes'] }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Ejes
                    </p>

                </div>

            </div>

        </div>


        <!-- Objetivos -->
        <div class="bg-white border border-gray-200 rounded-lg px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-slate-100
                            flex items-center justify-center flex-shrink-0">

                    <i class="bi bi-bullseye text-slate-600"></i>

                </div>

                <div>

                    <p class="text-xl font-semibold text-gray-800">
                        {{ $resumen['objetivos'] }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Objetivos
                    </p>

                </div>

            </div>

        </div>


        <!-- Políticas -->
        <div class="bg-white border border-gray-200 rounded-lg px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-slate-100
                            flex items-center justify-center flex-shrink-0">

                    <i class="bi bi-list-check text-slate-600"></i>

                </div>

                <div>

                    <p class="text-xl font-semibold text-gray-800">
                        {{ $resumen['politicas'] }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Políticas
                    </p>

                </div>

            </div>

        </div>


        <!-- Estrategias -->
        <div class="bg-white border border-gray-200 rounded-lg px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-slate-100
                            flex items-center justify-center flex-shrink-0">

                    <i class="bi bi-signpost-split text-slate-600"></i>

                </div>

                <div>

                    <p class="text-xl font-semibold text-gray-800">
                        {{ $resumen['estrategias'] }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Estrategias
                    </p>

                </div>

            </div>

        </div>


        <!-- Metas -->
        <div class="bg-white border border-gray-200 rounded-lg px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-slate-100
                            flex items-center justify-center flex-shrink-0">

                    <i class="bi bi-flag text-slate-600"></i>

                </div>

                <div>

                    <p class="text-xl font-semibold text-gray-800">
                        {{ $resumen['metas'] }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Metas
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         TÍTULO DE ESTRUCTURA
    ========================================================== -->
    <div class="flex items-center justify-between mb-3">

        <div>

            <h3 class="text-base font-semibold text-gray-800">
                Ejes y Objetivos Nacionales
            </h3>

            <p class="text-xs text-gray-500 mt-0.5">
                Organización estratégica del Plan Nacional de Desarrollo
            </p>

        </div>

    </div>

    <!-- =========================================================
         CONTENIDO CON SCROLL
    ========================================================== -->
    <div class="overflow-y-auto pr-1"
         style="height: calc(100vh - 430px); min-height: 260px;">

        @if($pnd && $pnd->ejes->isNotEmpty())

            <!-- Accordion de Ejes -->
            <div class="border border-gray-200 rounded-md overflow-hidden">

                @foreach($pnd->ejes as $eje)

                    <!-- Eje -->
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


                            <!-- Número + nombre del Eje -->
                            <div class="flex items-center gap-4 min-w-0">

                                <span
                                    class="w-14 flex-shrink-0
                                           text-sm font-semibold"
                                    :class="abierto
                                        ? 'text-blue-600'
                                        : 'text-gray-700'">

                                    Eje {{ $eje->numero }}

                                </span>

                                <span
                                    class="text-sm font-medium"
                                    :class="abierto
                                        ? 'text-blue-700'
                                        : 'text-gray-800'">

                                    {{ $eje->nombre }}

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


                        <!-- =================================================
                             OBJETIVOS DEL EJE
                        ================================================== -->
                        <div
                            x-show="abierto"
                            x-transition
                            x-cloak
                            class="bg-white">

                            @forelse($eje->objetivos as $objetivo)

                                <a href="{{ route('pnd.objetivo', $objetivo->id) }}"
                                class="flex items-start gap-4
                                        px-4 py-3
                                        border-t border-gray-100
                                        hover:bg-gray-50
                                        transition
                                        group">

                                    <!-- Número -->
                                    <span class="w-20 flex-shrink-0
                                                text-sm font-semibold
                                                text-gray-400">

                                        Objetivo {{ $objetivo->numero }}

                                    </span>


                                    <!-- Nombre -->
                                    <span class="flex-1
                                                text-sm text-gray-700
                                                leading-relaxed
                                                group-hover:text-blue-600
                                                group-hover:underline
                                                underline-offset-2">

                                        {{ $objetivo->nombre }}

                                    </span>


                                    <!-- Flecha -->
                                    <i class="bi bi-chevron-right
                                            text-gray-400
                                            group-hover:text-gray-600
                                            flex-shrink-0
                                            mt-0.5">
                                    </i>

                                </a>

                            @empty

                                <div class="px-4 py-6
                                            border-t border-gray-100
                                            text-center">

                                    <p class="text-sm text-gray-500">
                                        No existen objetivos registrados para este eje.
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white
                        border border-gray-200
                        rounded-md
                        py-8
                        text-center">

                <i class="bi bi-inbox text-2xl text-gray-300"></i>

                <p class="mt-2 text-sm text-gray-500">
                    No existe información registrada para el Plan Nacional de Desarrollo.
                </p>

            </div>

        @endif

    </div>


</x-catalogos-layout>