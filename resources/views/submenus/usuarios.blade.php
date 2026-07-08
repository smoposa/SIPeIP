<div class="h-full bg-[#ffffff]">

    <!-- Botón ocultar -->
    <div class="flex justify-end px-2 py-2 border-b">

        <button id="toggleSubmenu" class="text-gray-600 hover:text-[#024687]">
            <i class="bi bi-chevron-double-left"></i>
        </button>

    </div>

    <!-- Opciones -->
    <nav id="menuUsuarios">

        <a href="{{ route('usuarios.index') }}"
        class="{{ request()->routeIs('usuarios.index') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Página de inicio
        </a>

        <a href="{{ route('usuarios.listar') }}"
        class="{{ request()->routeIs('usuarios.listar') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Usuarios registrados
        </a>

        <a href="{{ route('usuarios.create') }}"
        class="{{ request()->routeIs('usuarios.create') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Crear usuario
        </a>

<!-- 
        <a href="{{ route('usuarios.desactivados') }}"
        class="{{ request()->routeIs('usuarios.desactivados') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Usuarios desactivados
        </a> -->

    </nav>

</div>