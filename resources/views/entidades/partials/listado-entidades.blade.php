
<!-- Listado de entidades -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Scroll independiente -->
    <div class="overflow-auto"
         style="height: calc(100vh - 280px);">

        <table class="min-w-full">

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
                        Nombre
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Siglas
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Tipo de Entidad
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Provincia
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                </tr>

            </thead>


            <!-- Registros -->
            <tbody>

                @forelse($entidades as $entidad)

                    <tr class="fila-entidad border-b border-gray-100 hover:bg-gray-50 transition">

                        <!-- Nro -->
                        <td class="px-4 py-2 text-sm text-gray-600">

                            {{ $entidades->firstItem() + $loop->index }}

                        </td>


                        <!-- Código institucional -->
                        <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">

                            {{ $entidad->codigoInstitucional }}

                        </td>


                        <!-- Nombre de la entidad -->
                        <td class="px-2 py-2 text-xs font-medium max-w-md">

                            <a href="{{ route('entidades.detalle', $entidad->id) }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                <span class="block overflow-hidden text-ellipsis line-clamp-2"
                                      title="{{ $entidad->nombre }}">

                                    {{ $entidad->nombre }}

                                </span>

                            </a>

                        </td>


                        <!-- Siglas -->
                        <td class="px-2 py-2 text-xs text-gray-600">

                            {{ $entidad->siglas }}

                        </td>


                        <!-- Tipo de entidad -->
                        <td class="px-2 py-2 text-xs text-gray-600">

                            {{ $entidad->tipoEntidad }}

                        </td>


                        <!-- Provincia -->
                        <td class="px-2 py-2 text-xs text-gray-600">

                            {{ $entidad->provincia }}

                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2">

                            @if($entidad->estado === 'Activo')

                                <span class="inline-flex items-center gap-1.5 text-xs text-green-600">

                                    <i class="bi bi-check-lg font-bold"></i>
                                    Activo

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 text-xs text-red-600">

                                    <i class="bi bi-x-lg font-bold"></i>
                                    Inactivo

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <!-- Sin registros -->
                    <tr>

                        <td colspan="7"
                            class="px-4 py-6 text-center text-gray-500">

                            No se encontraron entidades.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <!-- Paginación -->
    <x-pagination :paginator="$entidades" />

</div>
