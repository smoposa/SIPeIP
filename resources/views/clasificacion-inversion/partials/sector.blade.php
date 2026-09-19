<div class="overflow-hidden rounded-md border border-gray-200">

    {{-- Encabezado del sector --}}
    <div class="flex flex-col gap-2 bg-white px-4 py-2.5
                sm:flex-row sm:items-center sm:justify-between">

        <div class="flex flex-wrap items-center gap-2">

            <i class="bi bi-diagram-2 text-gray-400"></i>

            <span class="text-sm font-medium text-gray-700">
                {{ $sector->nombre }}
            </span>

            @if($sector->estado === 'Activo')

                <span class="rounded-full bg-green-50 px-2 py-0.5
                             text-[10px] font-medium text-green-700">
                    Activo
                </span>

            @else

                <span class="rounded-full bg-red-50 px-2 py-0.5
                             text-[10px] font-medium text-red-700">
                    Inactivo
                </span>

            @endif

        </div>

        <span class="text-xs text-gray-400">
            {{ $sector->subsectores->count() }}
            subsectores
        </span>

    </div>

    {{-- Tabla de subsectores --}}
    <div class="overflow-x-auto border-t border-gray-200">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">

                <tr>

                    <th
                        scope="col"
                        class="w-32 px-4 py-2 text-left text-xs
                               font-medium uppercase tracking-wide
                               text-gray-500"
                    >
                        Código
                    </th>

                    <th
                        scope="col"
                        class="px-4 py-2 text-left text-xs font-medium
                               uppercase tracking-wide text-gray-500"
                    >
                        Subsector
                    </th>

                    <th
                        scope="col"
                        class="w-40 px-4 py-2 text-left text-xs
                               font-medium uppercase tracking-wide
                               text-gray-500"
                    >
                        Nivel
                    </th>

                    <th
                        scope="col"
                        class="w-28 px-4 py-2 text-center text-xs
                               font-medium uppercase tracking-wide
                               text-gray-500"
                    >
                        Estado
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">

                @forelse($sector->subsectores as $subsector)

                    <tr class="transition hover:bg-gray-50">

                        <td class="whitespace-nowrap px-4 py-2.5">

                            <span class="font-mono text-xs font-semibold
                                         text-[#024687]">
                                {{ $subsector->codigo }}
                            </span>

                        </td>

                        <td class="px-4 py-2.5 text-sm text-gray-700">
                            {{ $subsector->nombre }}
                        </td>

                        <td class="whitespace-nowrap px-4 py-2.5
                                   text-xs text-gray-500">
                            {{ $subsector->nivel_gobierno }}
                        </td>

                        <td class="whitespace-nowrap px-4 py-2.5 text-center">

                            @if($subsector->estado === 'Activo')

                                <span class="inline-flex items-center gap-1.5
                                             rounded-full bg-green-50 px-2 py-1
                                             text-[11px] font-medium
                                             text-green-700">

                                    <span class="h-1.5 w-1.5 rounded-full
                                                 bg-green-500">
                                    </span>

                                    Activo

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5
                                             rounded-full bg-red-50 px-2 py-1
                                             text-[11px] font-medium
                                             text-red-700">

                                    <span class="h-1.5 w-1.5 rounded-full
                                                 bg-red-500">
                                    </span>

                                    Inactivo

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            class="px-4 py-4 text-center
                                   text-sm text-gray-500"
                        >
                            No existen subsectores registrados.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>