<!-- Metas del objetivo -->
<div class="border border-gray-200 rounded-lg overflow-hidden">
    <div class="overflow-auto" style="max-height: 65vh;">
        <table class="w-full" style="min-width: 640px;">
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                <tr>
                    <th class="w-16 px-4 py-2 text-center text-sm font-semibold text-gray-700">Nro</th>
                    <th class="w-24 px-2 py-2 text-center text-sm font-semibold text-gray-700">Número</th>
                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">Meta</th>
                    <th class="w-24 px-2 py-2 text-left text-sm font-semibold text-gray-700">Estado</th>
                    <th class="w-28 px-2 py-2 text-center text-sm font-semibold text-gray-700">Información</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objetivo->metas as $meta)
                    <tr data-fila-meta
                        data-busqueda="{{ $meta->numero }} {{ $meta->descripcion }}"
                        class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="px-4 py-2 text-center text-sm text-gray-600 align-top">{{ $loop->iteration }}</td>
                        <td class="px-2 py-2 text-center text-xs text-gray-600 whitespace-nowrap align-top">{{ $meta->numero }}</td>
                        <td class="px-2 py-2 text-xs text-gray-600 align-top whitespace-pre-line break-words">{{ $meta->descripcion }}</td>
                        <td class="px-2 py-2 align-top whitespace-nowrap">@if($meta->estado === 'Activo')
    <span class="inline-flex items-center gap-1.5 text-xs text-green-600">
        <i class="bi bi-check-lg" aria-hidden="true"></i> Activo
    </span>
@else
    <span class="inline-flex items-center gap-1.5 text-xs text-red-600">
        <i class="bi bi-x-lg" aria-hidden="true"></i> Inactivo
    </span>
@endif</td>
                        <td class="px-2 py-2 align-top text-center"><button type="button"
    data-detalle-pnd="meta"
    data-registro="{{ $meta->id }}"
    aria-haspopup="dialog"
    aria-controls="panelRegistroPnd"
    aria-label="Ver detalle de meta {{ $meta->id }}"
    class="text-xs text-blue-600 hover:text-blue-800 hover:underline">
    Detalle
</button></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                            No existen metas registradas para este objetivo.
                        </td>
                    </tr>
                @endforelse

                <tr data-sin-metas hidden>
                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                        No se encontraron metas con la búsqueda indicada.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
