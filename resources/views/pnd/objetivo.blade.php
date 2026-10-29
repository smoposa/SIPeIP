<x-catalogos-layout title="Detalle Objetivo PND">

    <!-- =========================================================
         ENCABEZADO
    ========================================================== -->
    <div class="mb-4">

        <div class="flex items-center justify-between gap-4">

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">
                    Objetivo Nacional {{ $objetivo->numero }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Plan Nacional de Desarrollo
                </p>
            </div>

            <!-- Regresar -->
            <a href="{{ route('pnd.index') }}"
               class="inline-flex items-center gap-2
                      px-3 py-2
                      text-sm font-medium
                      text-gray-600
                      bg-white
                      border border-gray-300
                      rounded-md
                      hover:bg-gray-50
                      transition">

                <i class="bi bi-arrow-left"></i>

                Regresar

            </a>

        </div>

    </div>


    <!-- =========================================================
         INFORMACIÓN DEL OBJETIVO
    ========================================================== -->
    <div class="bg-white border border-gray-200 rounded-lg mb-4">

        <div class="px-5 py-4">

            <div class="flex items-start gap-4">

                <!-- Número -->
                <div class="w-12 h-12
                            flex-shrink-0
                            rounded-lg
                            bg-gray-100
                            border border-gray-200
                            flex items-center justify-center">

                    <span class="text-lg font-semibold text-gray-700">
                        {{ $objetivo->numero }}
                    </span>

                </div>


                <!-- Información -->
                <div class="min-w-0 flex-1">

                    @if($objetivo->eje)

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400 mb-1">
                            Eje {{ $objetivo->eje->numero }} · {{ $objetivo->eje->nombre }}
                        </p>

                    @endif

                    <h3 class="text-base font-semibold text-gray-800 leading-relaxed">
                        {{ $objetivo->nombre }}
                    </h3>

                    @if($objetivo->descripcion)

                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            {{ $objetivo->descripcion }}
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         RESUMEN
    ========================================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-5">

        <!-- Políticas -->
        <div class="bg-white border border-gray-200 rounded-lg px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10
                            rounded-lg
                            bg-slate-100
                            flex items-center justify-center">

                    <i class="bi bi-list-check text-slate-600"></i>

                </div>

                <div>

                    <p class="text-xl font-semibold text-gray-800">
                        {{ $objetivo->politicas->count() }}
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

                <div class="w-10 h-10
                            rounded-lg
                            bg-slate-100
                            flex items-center justify-center">

                    <i class="bi bi-signpost-split text-slate-600"></i>

                </div>

                <div>

                    <p class="text-xl font-semibold text-gray-800">
                        {{ $objetivo->politicas->sum(
                            fn ($politica) => $politica->estrategias->count()
                        ) }}
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

                <div class="w-10 h-10
                            rounded-lg
                            bg-slate-100
                            flex items-center justify-center">

                    <i class="bi bi-flag text-slate-600"></i>

                </div>

                <div>

                    <p class="text-xl font-semibold text-gray-800">
                        {{ $objetivo->metas->count() }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Metas
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         CONTENIDO
    ========================================================== -->
    <div
        x-data="{ seccion: 'politicas' }"
        class="bg-white border border-gray-200 rounded-lg overflow-hidden">


        <!-- =====================================================
             PESTAÑAS
        ====================================================== -->
        <div class="flex border-b border-gray-200 bg-gray-50">

            <!-- Políticas -->
            <button
                type="button"
                @click="seccion = 'politicas'"
                class="px-5 py-3
                       text-sm font-medium
                       border-b-2
                       transition"
                :class="seccion === 'politicas'
                    ? 'border-blue-600 text-blue-700 bg-white'
                    : 'border-transparent text-gray-500 hover:text-gray-700'">

                Políticas y Estrategias

            </button>


            <!-- Metas -->
            <button
                type="button"
                @click="seccion = 'metas'"
                class="px-5 py-3
                       text-sm font-medium
                       border-b-2
                       transition"
                :class="seccion === 'metas'
                    ? 'border-blue-600 text-blue-700 bg-white'
                    : 'border-transparent text-gray-500 hover:text-gray-700'">

                Metas del Objetivo

            </button>

        </div>


        <!-- =====================================================
             POLÍTICAS Y ESTRATEGIAS
        ====================================================== -->
        <div
            x-show="seccion === 'politicas'"
            x-cloak
            class="p-4">

            <div class="border border-gray-200 rounded-md overflow-hidden">

                @forelse($objetivo->politicas as $politica)

                    <!-- Política -->
                    <div
                        x-data="{ abierto: false }"
                        class="border-b border-gray-200 last:border-b-0">


                        <!-- Encabezado -->
                        <button
                            type="button"
                            @click="abierto = !abierto"
                            class="w-full
                                   flex items-center justify-between
                                   px-4 py-3
                                   text-left
                                   transition"
                            :class="abierto
                                ? 'bg-blue-50'
                                : 'bg-gray-50 hover:bg-gray-100'">


                            <div class="flex items-start gap-4 min-w-0">

                                <!-- Código -->
                                <span
                                    class="w-24 flex-shrink-0
                                           text-sm font-semibold"
                                    :class="abierto
                                        ? 'text-blue-600'
                                        : 'text-gray-700'">

                                    Política {{ $politica->codigo }}

                                </span>


                                <!-- Política -->
                                <span
                                    class="text-sm font-medium leading-relaxed"
                                    :class="abierto
                                        ? 'text-blue-700'
                                        : 'text-gray-800'">

                                    {{ $politica->nombre }}

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


                        <!-- Estrategias -->
                        <div
                            x-show="abierto"
                            x-transition
                            x-cloak
                            class="bg-white border-t border-gray-100">

                            <div class="px-4 py-4">

                                <p class="text-xs font-semibold
                                          uppercase tracking-wide
                                          text-gray-400 mb-3">

                                    Estrategias

                                </p>


                                @forelse($politica->estrategias as $estrategia)

                                    <div class="flex items-start gap-3 mb-3 last:mb-0">

                                        <!-- Código -->
                                        <span class="w-7 h-7
                                                     flex-shrink-0
                                                     rounded-md
                                                     bg-gray-100
                                                     flex items-center justify-center
                                                     text-xs font-semibold
                                                     text-gray-600">

                                            {{ $estrategia->codigo }}

                                        </span>


                                        <!-- Descripción -->
                                        <p class="text-sm text-gray-600 leading-relaxed pt-0.5">

                                            {{ $estrategia->descripcion }}

                                        </p>

                                    </div>

                                @empty

                                    <p class="text-sm text-gray-500">
                                        No existen estrategias registradas para esta política.
                                    </p>

                                @endforelse

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="py-8 text-center text-sm text-gray-500">
                        No existen políticas registradas para este objetivo.
                    </div>

                @endforelse

            </div>

        </div>


        <!-- =====================================================
             METAS DEL OBJETIVO
        ====================================================== -->
        <div
            x-show="seccion === 'metas'"
            x-cloak
            class="p-4">

            <div class="border border-gray-200 rounded-md overflow-hidden">

                @forelse($objetivo->metas as $meta)

                    <div class="flex items-start gap-4
                                px-4 py-3
                                border-b border-gray-100
                                last:border-b-0
                                hover:bg-gray-50">

                        <!-- Número -->
                        <span class="w-16 flex-shrink-0
                                     text-sm font-semibold
                                     text-gray-500">

                            Meta {{ $meta->numero }}

                        </span>


                        <!-- Descripción -->
                        <p class="text-sm text-gray-700 leading-relaxed">

                            {{ $meta->descripcion }}

                        </p>

                    </div>

                @empty

                    <div class="py-8 text-center text-sm text-gray-500">
                        No existen metas registradas para este objetivo.
                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-catalogos-layout>