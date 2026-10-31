<!-- Barra de acciones -->
<div class="bg-white border-b border-gray-300 mb-0">

    <div class="flex flex-wrap items-center">

        <!-- Regresar -->
        <a href="{{ route('usuarios.index') }}"
           class="py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800 mr-8">

            <i class="bi bi-chevron-left" aria-hidden="true"></i>
            Regresar

        </a>


        <!-- Editar información -->
        @if(puedeHacer('usuarios', 'editar'))

            <a href="{{ route('usuarios.edit', $usuario->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-pencil text-blue-500 me-2"
                   aria-hidden="true"></i>
                Editar información

            </a>

        @endif


        <!-- Estado -->
        @if(puedeHacer('usuarios', 'estado'))

            <a href="{{ route('usuarios.estado', $usuario->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-check2-circle text-blue-500 me-2"
                   aria-hidden="true"></i>
                Estado

            </a>

        @endif


        <!-- Rol -->
        @if(puedeHacer('usuarios', 'editarRol'))

            <a href="{{ route('usuarios.editroles', $usuario->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-key-fill text-blue-500 me-2"
                   aria-hidden="true"></i>
                Rol

            </a>

        @endif


        <!-- Entidad -->
        @if(puedeHacer('usuarios', 'editarEntidad'))

            <a href="{{ route('usuarios.editentidad', $usuario->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-building text-blue-500 me-2"
                   aria-hidden="true"></i>
                Entidad

            </a>

        @endif


        <!-- Contraseña -->
        @if(puedeHacer('usuarios', 'editarPassword'))

            <a href="{{ route('usuarios.editpassword', $usuario->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-key text-blue-500 me-2"
                   aria-hidden="true"></i>
                Restablecer contraseña

            </a>

        @endif


        <!-- Actualizar -->
        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700
                  hover:bg-gray-100 transition">

            <i class="bi bi-arrow-clockwise text-blue-500 me-2"
               aria-hidden="true"></i>
            Actualizar

        </a>

    </div>

</div>