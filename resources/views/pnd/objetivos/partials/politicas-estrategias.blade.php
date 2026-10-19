<!-- Políticas y sus estrategias -->
<div class="border border-gray-200 rounded-lg overflow-hidden">
    <div class="overflow-auto" style="max-height: 65vh;">
        <table class="w-full" style="min-width: 800px;">
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                <tr>
                    <th class="w-16 px-4 py-2 text-center text-sm font-semibold text-gray-700">Nro</th>
                    <th class="w-24 px-2 py-2 text-left text-sm font-semibold text-gray-700">Código</th>
                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">Política</th>
                    <th class="w-24 px-2 py-2 text-center text-sm font-semibold text-gray-700">Estrategias</th>
                    <th class="w-24 px-2 py-2 text-left text-sm font-semibold text-gray-700">Estado</th>
                    <th class="w-28 px-2 py-2 text-center text-sm font-semibold text-gray-700">Información</th>
                </tr>
            </thead>

            <tbody>
                @forelse($objetivo->politicas as $politica)
                    <tr data-fila-politica
                        data-busqueda="{{ $politica->codigo }} {{ $politica->nombre }}"
                        class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <td class="px-4 py-2 text-center text-sm text-gray-600 align-top">{{ $loop->iteration }}</td>
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap align-top">{{ $politica->codigo }}</td>

                        <td class="px-2 py-2 text-xs text-gray-600 align-top">
                            <details id="politica-{{ $politica->id }}" class="group">
                                <summary class="cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                                    <span class="block whitespace-pre-line break-words">{{ $politica->nombre }}</span>
                                    <span class="mt-2 inline-flex items-center gap-2 text-xs font-medium text-blue-600 hover:text-blue-800">
                                        <i class="bi bi-chevron-down transition-transform group-open:rotate-180" aria-hidden="true"></i>
                                        <span class="group-open:hidden">Ver estrategias ({{ $politica->estrategias->count() }})</span>
                                        <span class="hidden group-open:inline">Ocultar estrategias</span>
                                    </span>
                                </summary>

                                <div class="mt-3 mb-2 border-l-2 border-gray-200 pl-3">
                                    <div class="mb-3 flex flex-wrap items-center justify-between gap-3">
                                        <p class="text-xs font-semibold text-gray-700">Estrategias de la política {{ $politica->codigo }}</p>

                                        @if(puedeHacer('pnd', 'crear'))
                                            <button type="button"
                                                data-crear-estrategia="{{ $politica->id }}"
                                                aria-haspopup="dialog"
                                                aria-controls="panelRegistroPnd"
                                                class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                                                <i class="bi bi-plus-lg" aria-hidden="true"></i>
                                                Registrar estrategia
                                            </button>
                                        @endif
                                    </div>

                                    <div class="overflow-x-auto rounded-md border border-gray-200">
                                        <table class="w-full" style="min-width: 560px;">
                                            <thead class="bg-gray-50 border-b border-gray-200">
                                                <tr>
                                                    <th class="px-2 py-2 text-left text-xs font-semibold text-gray-700">Código</th>
                                                    <th class="px-2 py-2 text-left text-xs font-semibold text-gray-700">Estrategia</th>
                                                    <th class="px-2 py-2 text-left text-xs font-semibold text-gray-700">Estado</th>
                                                    <th class="px-2 py-2 text-center text-xs font-semibold text-gray-700">Información</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($politica->estrategias as $estrategia)
                                                    <tr data-fila-estrategia
                                                        data-busqueda="{{ $estrategia->codigo }} {{ $estrategia->descripcion }}"
                                                        class="border-b border-gray-100 hover:bg-gray-50">
                                                        <td class="px-2 py-2 align-top text-xs text-gray-600 whitespace-nowrap">{{ $estrategia->codigo }}</td>
                                                        <td class="px-2 py-2 align-top text-xs text-gray-600 whitespace-pre-line break-words">{{ $estrategia->descripcion }}</td>
                                                        <td class="px-2 py-2 align-top whitespace-nowrap">@if($estrategia->estado === 'Activo')
    <span class="inline-flex items-center gap-1.5 text-xs text-green-600">
        <i class="bi bi-check-lg" aria-hidden="true"></i> Activo
    </span>
@else
    <span class="inline-flex items-center gap-1.5 text-xs text-red-600">
        <i class="bi bi-x-lg" aria-hidden="true"></i> Inactivo
    </span>
@endif</td>
                                                        <td class="px-2 py-2 align-top text-center"><button type="button"
    data-detalle-pnd="estrategia"
    data-registro="{{ $estrategia->id }}"
    aria-haspopup="dialog"
    aria-controls="panelRegistroPnd"
    aria-label="Ver detalle de estrategia {{ $estrategia->id }}"
    class="text-xs text-blue-600 hover:text-blue-800 hover:underline">
    Detalle
</button></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="px-4 py-4 text-center text-xs text-gray-500">
                                                            No existen estrategias registradas para esta política.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </details>
                        </td>

                        <td class="px-2 py-2 align-top text-center text-xs text-gray-600">{{ $politica->estrategias->count() }}</td>
                        <td class="px-2 py-2 align-top whitespace-nowrap">@if($politica->estado === 'Activo')
    <span class="inline-flex items-center gap-1.5 text-xs text-green-600">
        <i class="bi bi-check-lg" aria-hidden="true"></i> Activo
    </span>
@else
    <span class="inline-flex items-center gap-1.5 text-xs text-red-600">
        <i class="bi bi-x-lg" aria-hidden="true"></i> Inactivo
    </span>
@endif</td>
                        <td class="px-2 py-2 align-top text-center"><button type="button"
    data-detalle-pnd="politica"
    data-registro="{{ $politica->id }}"
    aria-haspopup="dialog"
    aria-controls="panelRegistroPnd"
    aria-label="Ver detalle de politica {{ $politica->id }}"
    class="text-xs text-blue-600 hover:text-blue-800 hover:underline">
    Detalle
</button></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                            No existen políticas registradas para este objetivo.
                        </td>
                    </tr>
                @endforelse

                <tr data-sin-politicas hidden>
                    <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                        No se encontraron políticas ni estrategias con la búsqueda indicada.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
