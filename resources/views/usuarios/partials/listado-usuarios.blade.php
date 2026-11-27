
<!-- Listado de usuarios -->
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
                        Usuario
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Identificación
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Rol
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Entidad
                    </th>

                    <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                        Estado
                    </th>

                </tr>

            </thead>


            <!-- Registros -->
            <tbody id="tablaUsuarios">

                @php
                    $grupoAnterior = null;
                @endphp

                @if($usuarios->isNotEmpty())

                    @foreach($usuarios as $usuario)

                        @php
                            $grupoActual = (string) ($usuario->entidad_id ?? 'sin_entidad');
                        @endphp


                        <!-- Agrupación de usuarios por entidad -->
                        @if($esGlobal && $grupoActual !== $grupoAnterior)

                            <tr class="bg-gray-100 border-b border-gray-200">

                                <td colspan="6"
                                    class="px-4 py-2 text-xs font-semibold text-gray-700">

                                    <i class="bi bi-building mr-2"></i>

                                    {{ $usuario->entidad?->nombre ?? 'Sin entidad asignada' }}

                                </td>

                            </tr>

                        @endif

                        @php
                            $grupoAnterior = $grupoActual;
                        @endphp


                        <!-- Información del usuario -->
                        <tr class="fila-usuario border-b border-gray-100 hover:bg-gray-50 transition">

                            <!-- Nro -->
                            <td class="px-4 py-2 text-sm text-gray-600">

                                {{ $usuarios->firstItem() + $loop->index }}

                            </td>


                            <!-- Preparación de iniciales e identificación -->
                            @php
                                $iniciales = mb_strtoupper(
                                    mb_substr(trim($usuario->nombres ?? ''), 0, 1) .
                                    mb_substr(trim($usuario->apellidos ?? ''), 0, 1)
                                );

                                $identificacion = (string) ($usuario->identificacion ?? '');
                            @endphp


                            <!-- Usuario -->
                            <td class="px-2 py-2">

                                <div class="flex items-center gap-2">

                                    <!-- Avatar con iniciales -->
                                    <span
                                        aria-hidden="true"
                                        class="inline-flex h-8 w-8 shrink-0 items-center
                                               justify-center rounded-full bg-blue-100
                                               text-xs font-semibold text-blue-700">

                                        {{ $iniciales ?: '?' }}

                                    </span>


                                    <!-- Nombre y correo electrónico -->
                                    <div class="min-w-0">

                                        <a href="{{ route('usuarios.show', $usuario->id) }}"
                                           class="text-xs font-medium text-blue-600
                                                  hover:text-blue-800 hover:underline">

                                            {{ $usuario->nombres }} {{ $usuario->apellidos }}

                                        </a>

                                        <p class="text-xs text-gray-500 break-all">

                                            {{ $usuario->email }}

                                        </p>

                                    </div>

                                </div>

                            </td>


                            <!-- Identificación protegida -->
                            <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">

                                {{
                                    $identificacion === ''
                                        ? '—'
                                        : str_repeat('•', max(0, mb_strlen($identificacion) - 4))
                                            . mb_substr($identificacion, -4)
                                }}

                            </td>


                            <!-- Rol -->
                            <td class="px-2 py-2 text-xs text-gray-700">

                                {{ $usuario->rol?->nombre ?? 'Sin rol asignado' }}

                            </td>


                            <!-- Entidad -->
                            <td class="px-2 py-2 text-xs text-gray-600"
                                title="{{ $usuario->entidad?->nombre ?? 'Sin entidad asignada' }}">

                                {{ $usuario->entidad?->siglas ?: ($usuario->entidad?->nombre ?? 'Sin entidad') }}

                            </td>


                            <!-- Estado -->
                            <td class="px-2 py-2">

                                @if($usuario->estado === 'Activo')

                                    <span class="inline-flex items-center gap-1.5 text-xs text-green-600">

                                        <i class="bi bi-check-lg font-bold"></i>
                                        Habilitado

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 text-xs text-red-600">

                                        <i class="bi bi-x-lg font-bold"></i>
                                        Deshabilitado

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                @else

                    <!-- Sin registros -->
                    <tr>

                        <td colspan="6"
                            class="px-4 py-6 text-center text-gray-500">

                            No se encontraron usuarios.

                        </td>

                    </tr>

                @endif

            </tbody>

        </table>

    </div>


    <!-- Paginación -->
    <x-pagination :paginator="$usuarios" />

</div>
