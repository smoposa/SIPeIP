<!-- Encabezado de asignaciones -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Asignaciones
        </h4>

    </div>

</div>


<!-- Asignaciones -->
<div class="px-4 py-4">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        <!-- Roles -->
        <div class="border border-gray-200 rounded-lg p-6 bg-white">

            <div class="grid grid-cols-[60px_1fr_auto] items-center gap-4">

                <!-- Icono -->
                <div>
                    <i class="bi bi-key-fill text-4xl text-yellow-500"></i>
                </div>


                <!-- Información -->
                <div>

                    <h5 class="text-sm font-semibold text-gray-700 mb-2">
                        Roles asignados
                    </h5>

                    <p class="text-sm text-gray-800">
                        {{ $usuario->rol?->nombre ?? 'No asignado' }}
                    </p>

                    @if($usuario->rol?->created_at)

                        <p class="text-xs text-gray-500 mt-1">
                            Creado el {{ $usuario->rol->created_at->format('d/m/Y') }}
                        </p>

                    @endif

                </div>


                <!-- Acción -->
                <div>

                    @if(puedeHacer('usuarios', 'editarRol'))

                        <a href="{{ route('usuarios.editroles', $usuario->id) }}"
                           class="text-sm text-blue-600 hover:text-blue-800">

                            Editar

                        </a>

                    @endif

                </div>

            </div>

        </div>


        <!-- Entidad -->
        <div class="border border-gray-200 rounded-lg p-6 bg-white">

            <div class="grid grid-cols-[60px_1fr_auto] items-center gap-4">

                <!-- Icono -->
                <div>
                    <i class="bi bi-building text-4xl text-cyan-500"></i>
                </div>


                <!-- Información -->
                <div>

                    <h5 class="text-sm font-semibold text-gray-700 mb-2">
                        Entidad asignada
                    </h5>

                    <p class="text-sm text-gray-800">
                        {{ $usuario->entidad?->nombre ?? 'No asignada' }}
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        Entidad institucional del usuario
                    </p>

                </div>


                <!-- Acción -->
                <div>

                    @if(puedeHacer('usuarios', 'editarEntidad'))

                        <a href="{{ route('usuarios.editentidad', $usuario->id) }}"
                           class="text-sm text-blue-600 hover:text-blue-800">

                            Editar

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>