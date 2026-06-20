<div class="h-screen bg-[#ffffff]">

    <!-- Botón ocultar -->
    <div class="flex justify-end px-2 py-2 border-b">

        <button id="toggleSubmenu" class="text-gray-600 hover:text-[#024687]">
            <i class="bi bi-chevron-double-left"></i>
        </button>

    </div>

    <!-- Opciones -->
    <nav id="menuRoles">

        <a href="{{ route('roles.index') }}"
        class="{{ request()->routeIs('roles.index') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Página de inicio
        </a>

        <a href="{{ route('roles.listar') }}"
        class="{{ request()->routeIs('roles.listar') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Cosultar roles
        </a>

        <a href="{{ route('roles.create') }}"
        class="{{ request()->routeIs('roles.create') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Crear rol
        </a>

    <!--         <a href="{{ route('roles.desactivados') }}"
        class="{{ request()->routeIs('roles.desactivados') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Roles desactivados
        </a>-->

    </nav>

</div>