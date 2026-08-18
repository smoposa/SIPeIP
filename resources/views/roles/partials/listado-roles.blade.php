{{-- =========================================================
     LISTADO DE ROLES
========================================================== --}}
<div class="border border-gray-200 rounded-lg overflow-hidden">

    {{-- Scroll independiente --}}
    <div class="overflow-y-auto"
         style="height: calc(100vh - 220px);">

        <table class="min-w-full">

            {{-- Encabezado fijo --}}
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Rol
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Descripción
                    </th>

                    <th class="px-2 py-2 text-center text-sm font-semibold text-gray-700 whitespace-nowrap">
                        Usuarios asignados
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                </tr>

            </thead>


            <tbody id="tablaRoles">

                @forelse($roles as $rol)

                    <tr
                        class="fila-rol border-b border-gray-100 hover:bg-gray-50 transition"
                        data-nombre="{{ strtolower($rol->nombre) }}"
                        data-descripcion="{{ strtolower($rol->descripcion ?? '') }}"
                        data-estado="{{ $rol->estado }}"
                    >

                        {{-- Nro --}}
                        <td class="px-4 py-2 text-sm text-gray-600">
                            {{ $loop->iteration }}
                        </td>


                        {{-- Rol --}}
                        <td class="px-2 py-2 text-xs font-medium">

                            <a href="{{ route('roles.detalle', $rol->id) }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                {{ $rol->nombre }}

                            </a>

                        </td>


                        {{-- Descripción --}}
                        <td class="px-2 py-2 text-xs text-gray-600">

                            {{ $rol->descripcion }}

                        </td>


                        {{-- Usuarios asignados --}}
                        <td class="px-2 py-2 text-xs text-center text-gray-600">

                            {{ $rol->users_count }}

                        </td>


                        {{-- Estado --}}
                        <td class="px-2 py-2">

                            @if($rol->estado === 'Activo')

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

                    <tr>

                        <td colspan="5"
                            class="px-4 py-6 text-center text-gray-500">

                            No existen roles registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>