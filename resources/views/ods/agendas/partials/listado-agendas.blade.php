<div class="border border-gray-200 rounded-lg overflow-hidden">
    <div class="overflow-auto" style="height: calc(100vh - 290px);">
        <table class="min-w-full">
            <thead class="sticky top-0 z-10" style="background:#024687;color:white">
                <tr><th class="px-2 py-2 text-center text-sm font-semibold">Nro</th><th class="px-2 py-2 text-center text-sm font-semibold">Agenda</th><th class="px-2 py-2 text-center text-sm font-semibold">Objetivos</th><th class="px-2 py-2 text-center text-sm font-semibold">Período</th><th class="px-2 py-2 text-center text-sm font-semibold">Estado</th><th class="px-2 py-2 text-center text-sm font-semibold">Información</th></tr>
            </thead>
            <tbody>
                @forelse($agendas as $agenda)
                    <tr class="fila-agenda border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-2 text-center text-sm text-gray-600">{{ $agendas->firstItem() + $loop->index }}</td>
                        <td class="px-2 py-2 text-xs font-medium"><a class="text-blue-600 hover:underline" href="{{ route('ods.objetivos.index', ['agenda' => $agenda->id]) }}">{{ $agenda->nombre }}</a></td><td class="text-center text-xs">{{ $agenda->ods_count }}</td><td class="text-center text-xs">{{ $agenda->periodo_inicio }}–{{ $agenda->periodo_fin }}</td>
                        <td class="px-2 py-2 text-center whitespace-nowrap">
                            @if($agenda->estado === 'Activo')
                                <span class="text-xs text-green-600"><i class="bi bi-check-lg"></i> Activo</span>
                            @else
                                <span class="text-xs text-red-600"><i class="bi bi-x-lg"></i> Inactivo</span>
                            @endif
                        </td>
                        <td class="px-2 py-2 text-center"><button type="button" data-ver-agenda="{{ $agenda->id }}" aria-haspopup="dialog" aria-controls="panelAgenda" class="text-xs text-blue-600 hover:underline">Detalle</button></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">No se encontraron registros.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$agendas" />
</div>
