<!-- Barra de acciones -->
<div class="bg-white border-b border-gray-300 mb-0">

    <div class="flex">

        <!-- Regresar -->
        <a href="{{ route('usuarios.index') }}"
           class="py-2 text-sm font-medium text-blue-500
                  hover:text-blue-800 mr-8">

            <i class="bi bi-chevron-left"></i>
            Regresar

        </a>


        <!-- Editar información -->
        @if(puedeHacer('usuarios', 'editar'))

            <a href="{{ route('usuarios.edit', $usuario->id) }}"
               class="px-3 py-2 text-sm text-gray-700
                      hover:bg-gray-100 transition">

                <i class="bi bi-pencil text-blue-500 me-2"></i>
                Editar información

            </a>

        @endif


        <!-- Estado -->
        <a href="{{ route('usuarios.estado', $usuario->id) }}"
           class="px-3 py-2 text-sm text-gray-700
                  hover:bg-gray-100 transition">

            <i class="bi bi-check2-circle text-blue-500 me-2"></i>
            Estado

        </a>


        <!-- Rol -->
        <a href="{{ route('usuarios.editroles', $usuario->id) }}"
           class="px-3 py-2 text-sm text-gray-700
                  hover:bg-gray-100 transition">

            <i class="bi bi-briefcase text-blue-500 me-1"></i>
            Rol

        </a>


        <!-- Restablecer contraseña -->
        <a href="{{ route('usuarios.editpassword', $usuario->id) }}"
           class="px-3 py-2 text-sm text-gray-700
                  hover:bg-gray-100 transition">

            <i class="bi bi-key text-blue-500 inline-block rotate-45 me-1"></i>
            Restablecer contraseña

        </a>


        <!-- Actualizar -->
        <a href="{{ url()->current() }}"
           class="px-3 py-2 text-sm text-gray-700
                  hover:bg-gray-100 transition">

            <i class="bi bi-arrow-clockwise text-blue-500 me-1"></i>
            Actualizar

        </a>

    </div>

</div>