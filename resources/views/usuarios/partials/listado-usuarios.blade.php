<!-- Listado de usuarios -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Scroll independiente -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 260px);">

        <table class="min-w-full">

            <!-- Encabezado fijo -->
            <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                <tr>

                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                        Nro
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Usuario
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Cargo
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Entidad
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                </tr>

            </thead>


            <tbody id="tablaUsuarios">

                @forelse($usuarios as $usuario)

                    <tr
                        class="fila-usuario border-b border-gray-100 hover:bg-gray-50 transition"

                        data-nombre="{{ strtolower(($usuario->nombres ?? '') . ' ' . ($usuario->apellidos ?? '')) }}"
                        data-email="{{ strtolower($usuario->email ?? '') }}"
                        data-identificacion="{{ strtolower($usuario->identificacion ?? '') }}"
                        data-cargo="{{ strtolower($usuario->cargo ?? '') }}"
                        data-rol="{{ strtolower($usuario->rol?->nombre ?? '') }}"
                        data-entidad="{{ strtolower($usuario->entidad?->nombre ?? '') }}"
                        data-estado="{{ $usuario->estado }}"
                    >

                        <!-- Nro -->
                        <td class="px-4 py-2 text-sm text-gray-600">

                            {{ $loop->iteration }}

                        </td>


                        <!-- Usuario -->
                        <td class="px-2 py-2">

                            <a href="{{ route('usuarios.show', $usuario->id) }}"
                               class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline">

                                {{ $usuario->nombres }} {{ $usuario->apellidos }}

                            </a>

                            <p class="text-xs text-gray-500 mt-0.5">

                                {{ $usuario->email }}

                            </p>

                            <p class="text-xs text-gray-600 mt-0.5">

                                {{ $usuario->rol?->nombre ?? 'Sin rol asignado' }}

                            </p>

                        </td>


                        <!-- Cargo -->
                        <td class="px-2 py-2 text-xs text-gray-600">

                            {{ $usuario->cargo ?? 'Sin cargo' }}

                        </td>


                        <!-- Entidad -->
                        <td class="px-2 py-2 text-xs text-gray-600 max-w-sm">

                            <span
                                class="block overflow-hidden text-ellipsis line-clamp-2"
                                title="{{ $usuario->entidad?->nombre ?? 'Sin entidad' }}">

                                {{ $usuario->entidad?->nombre ?? 'Sin entidad' }}

                            </span>

                        </td>


                        <!-- Estado -->
                        <td class="px-2 py-2">

                            @if($usuario->estado === 'Activo')

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

                            No existen usuarios registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>