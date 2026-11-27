@props(['paginator'])

<div data-pagination
     class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 border-t border-gray-200">

    <!-- Paginación -->
    <nav aria-label="Navegación de páginas">

        <ul class="inline-flex items-center -space-x-px text-sm">

            <!-- Página anterior -->
            <li>
                @if($paginator->onFirstPage())

                    <span class="flex items-center justify-center px-3 h-8
                                 border border-gray-300 rounded-l-md
                                 bg-gray-100 text-gray-400 cursor-not-allowed"
                          aria-disabled="true">
                        &laquo;
                    </span>

                @else

                    <a href="{{ $paginator->previousPageUrl() }}"
                       aria-label="Página anterior"
                       class="flex items-center justify-center px-3 h-8
                              border border-gray-300 rounded-l-md
                              bg-white text-blue-600 hover:bg-blue-50">
                        &laquo;
                    </a>

                @endif
            </li>

            <!-- Números de página -->
            @php
                $inicio = max(1, $paginator->currentPage() - 2);
                $fin = min($paginator->lastPage(), $paginator->currentPage() + 2);

                $paginas = collect([1])
                    ->merge(range($inicio, max($inicio, $fin)))
                    ->push($paginator->lastPage())
                    ->unique()
                    ->sort()
                    ->values();
            @endphp

            @foreach($paginas as $pagina)

                <!-- Separador de páginas -->
                @if(!$loop->first && $pagina - $paginas[$loop->index - 1] > 1)

                    <li>
                        <span class="flex items-center justify-center px-3 h-8
                                     border border-gray-300 bg-white text-gray-400">
                            ...
                        </span>
                    </li>

                @endif

                <li>
                    @if($pagina == $paginator->currentPage())

                        <span aria-current="page"
                              class="relative z-10 flex items-center justify-center
                                     px-3 h-8 border border-blue-600
                                     bg-blue-600 text-white font-medium">
                            {{ $pagina }}
                        </span>

                    @else

                        <a href="{{ $paginator->url($pagina) }}"
                           aria-label="Página {{ $pagina }}"
                           class="flex items-center justify-center px-3 h-8
                                  border border-gray-300 bg-white
                                  text-blue-600 hover:bg-blue-50">
                            {{ $pagina }}
                        </a>

                    @endif
                </li>

            @endforeach

            <!-- Página siguiente -->
            <li>
                @if($paginator->hasMorePages())

                    <a href="{{ $paginator->nextPageUrl() }}"
                       aria-label="Página siguiente"
                       class="flex items-center justify-center px-3 h-8
                              border border-gray-300 rounded-r-md
                              bg-white text-blue-600 hover:bg-blue-50">
                        &raquo;
                    </a>

                @else

                    <span class="flex items-center justify-center px-3 h-8
                                 border border-gray-300 rounded-r-md
                                 bg-gray-100 text-gray-400 cursor-not-allowed"
                          aria-disabled="true">
                        &raquo;
                    </span>

                @endif
            </li>

        </ul>

    </nav>

    <!-- Resumen de registros -->
    <div class="text-xs text-gray-500">

        Mostrando
        <span class="font-medium">
            {{ $paginator->firstItem() ?? 0 }}
        </span>
        al
        <span class="font-medium">
            {{ $paginator->lastItem() ?? 0 }}
        </span>
        de
        <span class="font-medium">
            {{ $paginator->total() }}
        </span>
        registros

    </div>

</div>
