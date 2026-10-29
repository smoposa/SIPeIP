<!-- Encabezado de información básica -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="flex justify-between items-center px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información básica
        </h4>

        @if(puedeHacer('usuarios', 'editar'))

            <a href="{{ route('usuarios.edit', $usuario->id) }}"
               class="text-sm text-blue-600 hover:text-blue-800">

                Editar

            </a>

        @endif

    </div>

</div>


<!-- Información básica -->
<div class="px-4 py-2">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 mb-6">

        <!-- Columna izquierda -->
        <div class="space-y-4">

            <!-- Identificación -->
            <div class="flex">

                <span class="w-40 text-sm font-semibold text-gray-700">
                    Identificación
                </span>

                <span class="text-sm text-gray-600">
                    {{ $usuario->identificacion }}
                </span>

            </div>


            <!-- Nombres -->
            <div class="flex">

                <span class="w-40 text-sm font-semibold text-gray-700">
                    Nombres
                </span>

                <span class="text-sm text-gray-600">
                    {{ $usuario->nombres }}
                </span>

            </div>


            <!-- Apellidos -->
            <div class="flex">

                <span class="w-40 text-sm font-semibold text-gray-700">
                    Apellidos
                </span>

                <span class="text-sm text-gray-600">
                    {{ $usuario->apellidos }}
                </span>

            </div>


            <!-- Correo -->
            <div class="flex">

                <span class="w-40 text-sm font-semibold text-gray-700">
                    Correo
                </span>

                <span class="text-sm text-gray-600">
                    {{ $usuario->email }}
                </span>

            </div>

        </div>


        <!-- Columna derecha -->
        <div class="space-y-4">

            <!-- Entidad -->
            <div class="flex">

                <span class="w-40 text-sm font-semibold text-gray-700">
                    Entidad
                </span>

                <span class="text-sm text-gray-600">
                    {{ $usuario->entidad?->nombre ?: 'No asignada' }}
                </span>

            </div>


            <!-- Cargo -->
            <div class="flex">

                <span class="w-40 text-sm font-semibold text-gray-700">
                    Cargo
                </span>

                <span class="text-sm text-gray-600">
                    {{ $usuario->cargo ?: 'No registra' }}
                </span>

            </div>


            <!-- Rol -->
            <div class="flex">

                <span class="w-40 text-sm font-semibold text-gray-700">
                    Rol
                </span>

                <span class="text-sm text-gray-600">
                    {{ $usuario->rol?->nombre ?: 'No asignado' }}
                </span>

            </div>

        </div>

    </div>

</div>