<!-- Listado de metas -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 240px);">

        <table class="w-full table-fixed"
               style="min-width: 640px;">

            <!-- Anchos fijos para mantener la alineación del acordeón -->
            <colgroup>

                <col style="width: 50px;">
                <col style="width: 65px;">
                <col>
                <col style="width: 90px;">
                <col style="width: 110px;">

            </colgroup>


            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Código
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Meta
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700">
                        Información
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($ods->metas as $meta)

                    <tr
                        class="fila-meta border-b border-gray-100 hover:bg-gray-50 transition"
                        data-codigo="{{ $meta->codigo }}"
                        data-nombre="{{ $meta->nombre }}"
                        data-estado="{{ $meta->estado }}"
                    >

                        <!-- Nro -->
                        <td class="px-4 py-2 text-sm text-gray-600 align-top">
                            {{ $loop->iteration }}
                        </td>


                        <!-- Código -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap align-top">
                            {{ $meta->codigo }}
                        </td>


                        <!-- Meta y descripción -->
                        <td class="px-2 py-2 text-xs text-gray-600 align-top">

                            @if(filled($meta->descripcion))

                                <details class="group">

                                    <summary
                                        class="flex items-start gap-2 cursor-pointer list-none
                                               [&::-webkit-details-marker]:hidden">

                                        <i class="bi bi-chevron-down shrink-0 text-blue-500
                                                  transition-transform group-open:rotate-180"
                                           aria-hidden="true"></i>

                                        <span class="min-w-0 whitespace-pre-line break-words">{{ $meta->nombre }}</span>

                                    </summary>


                                    <!-- Descripción desplegable -->
                                    <div class="mt-3 ml-5 border-l-2 border-gray-200 pl-3">

                                        <p class="mb-1 text-xs font-semibold text-gray-700">
                                            Descripción
                                        </p>

                                        <p class="text-xs text-gray-600 whitespace-pre-line break-words">{{ $meta->descripcion }}</p>

                                    </div>

                                </details>

                            @else

                                <span class="block whitespace-pre-line break-words">{{ $meta->nombre }}</span>

                            @endif

                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2 whitespace-nowrap align-top">

                            @if($meta->estado === 'Activo')

                                <span class="inline-flex items-center gap-1.5 text-xs text-green-600">

                                    <i class="bi bi-check-lg font-bold" aria-hidden="true"></i>
                                    Activo

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 text-xs text-red-600">

                                    <i class="bi bi-x-lg font-bold" aria-hidden="true"></i>
                                    Inactivo

                                </span>

                            @endif

                        </td>


                        <!-- Información -->
                        <td class="px-2 py-2 text-center align-top">

                            <button
                                type="button"
                                data-ver-meta="{{ $meta->id }}"
                                title="Ver detalle de la meta"
                                aria-label="Ver detalle de la meta {{ $meta->codigo }}"
                                aria-haspopup="dialog"
                                aria-controls="panelMeta"
                                class="text-xs text-blue-600 hover:text-blue-800 hover:underline">

                                Detalle

                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="px-4 py-6 text-center text-sm text-gray-500">

                            No existen metas registradas para este objetivo.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>